<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\Action;
use App\Http\Controllers\CartController;
use App\Mail\SubmittedOrder;
use App\DataTables\OrderDataTable;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Status;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Payment\Exceptions\InvalidPaymentException;
use Auth;
use DB;

class OrderController extends Controller
{   

    // Datatable To blade
    public function list() {
        // dataTable
        $dataTable = new OrderDataTable();

        // Order table
        $vars["orderTable"] = $dataTable->html();

        return view('order.list', $vars);
    }

    // Get order
    public function orderTable(OrderDataTable $dataTable) {
        return $dataTable->render('order.list');
    }

    // delete
    public function delete(Action $action,$id) {
        return $action->delete(Order::class, $id);
    }

    // Show user's carts
    public function showCart(CartController $cart) {
        return $cart->show();
    }

    // Show users's order
    public function showOrder() {
        $orders = Order::where('user_id', auth()->user()->id)
            ->whereNotNull('factor')->get();

        return response()->json($orders);
    }

    // Details
    public function details(Request $request) {
        // Each order 
        $vars['order'] = Order::where('factor', $request->get('factor'))->first();
        // Cart
        $vars['carts'] = Cart::where('factor', $request->get('factor'))->get();

        if($request->get('role') != 'admin')
            return response()->json($vars);

        return view('order.details', $vars);
    }

    // Order
    public $order;

    // Submit final order
    public function store() {
        $user_id = Auth::user()->id;

        // Count unpaid order
        $unpaidOrder = Order::where('user_id',  $user_id)->whereHas('statuses', function($query) {
            $query->active();
        })->count();

        // Number of unpaid order
        if($unpaidOrder > 4) {
            return response()->json('شما اجازه داشتن بیش از ۴ سفارش پرداخت نشده ندارید', JSON_UNESCAPED_UNICODE);
        } 
        else {
            DB::beginTransaction();

            try {
                // New order
                $this->order = new Order();
                // Username
                $this->order->user_id = $user_id;
                // Count orders where user_id is
                $orderCount = Cart::where('user_id',  $user_id)->count() . 1001;
                // Order factor
                $factor = 'saraRajabi' . $orderCount .  $user_id;
                $this->order->factor = $factor;

                // Set order factor for all carts
                $cartFactors = Cart::where('user_id',  $user_id)
                    ->whereNull('factor')->get();

                foreach($cartFactors as $cartFactor) {
                    $cartFactor->factor = $factor;
                    $cartFactor->save();
                }

                // Order total price
                $sum = 0;
                $carts = Cart::where('factor', $factor)->get();
                foreach($carts as $cart) {
                    $sum += $cart->course->price;
                }
                // Total price
                $this->order->total_price = $sum;

                if($sum == 0) {

                    $this->order->save();
                    DB::commit();

                    // Email
                    Mail::to(auth()->user()->email)->send(new SubmittedOrder($this->order, $carts));
                    return Redirect::to('/'); // Paid

                } else {
                    // Create new invoice.
                    $invoice = new Invoice;

                    // // Set invoice amount.
                    $invoice->amount(100000);
                    $invoice->Uuid($this->order->factor);
                    $invoice->transactionId('test');
                    $invoice->detail(['name','yoRRskdsakjdjksadjkskdksdjkasdjkasjkd']);
                    $invoice->detail(['phone','your detail1 goes here']);
                    $invoice->detail(['email','your detail1 goes here']);
                    $invoice->detail(['description','your detail1 goes here']);

                    $payment = Payment::purchase($invoice, function($driver, $transactionId) {
                        // Store transactionId in database, to verify payment in future.
                        $this->order->test = $transactionId;
                        // Save order
                        $this->order->save();

                        DB::commit();

                    })->pay()->render();

                    return $payment;
                }

            } catch(Exception $e) {
                throw $e;
                DB::rollBack();
            }
        }
    }

    // Verify payment
    public function verify(Request $request) {
        # you need to verify the payment to insure the invoice has been paid successfully
        try {
            $receipt = Payment::amount(1000)->transactionId($transaction_id)->verify();

            // you can show payment's referenceId to user
            echo $receipt->getReferenceId();

        } catch (InvalidPaymentException $exception) {
            // when payment is not verified , it throw an exception.
            echo $exception->getMessage();
        }
    }
}
