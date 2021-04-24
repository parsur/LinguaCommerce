<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Status;
use App\Models\User;
use App\Providers\Action;
use App\Mail\SubmittedOrder;
use App\DataTables\OrderDataTable;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Auth;
use DB;

class OrderController extends Controller
{   

    // Facing any error, fix here
    public function __construct() {
        $this->middleware(['auth:sanctum', 'verified'])->except(['verify', 'list', 'orderTable']);
    }

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

    // Delete
    public function delete(Action $action,$id) {
        return $action->delete(Order::class, $id);
    }

    // Show the user's carts
    public function showCart(CartController $cart) {
        return $cart->show();
    }

    // Show the users's orders
    public function showOrder(CartAction $cart) {
        $vars['orders'] = Order::where('user_id', auth()->user()->id)->with('user:name,phone_number,email')->get();
        return response()->json($vars);
    }

    // Details
    public function details(Request $request) {
        // Each order 
        $vars['order'] = Order::where('factor', $request->get('factor'))->first();
        // Cart
        $vars['carts'] = Cart::where('factor', $request->get('factor'))->get();

        if($request->has('admin'))
            return view('order.details', $vars);

        return response()->json($vars);
    }

    // Submit final order
    public function store() {
        // User
        $user = User::find(Auth::user()->id); 

        DB::beginTransaction();
        try {

            $order = new Order();
            // Number of unpaid orders
            if($order->hasExceededOrder()) {
                return $this->responseWithError('شما اجازه داشتن بیش از چهار سفارش پرداخت نشده ندارید', Response::HTTP_FORBIDDEN);
            }
            // Factor
            $factor = 'Rajabi-' . uniqid();

            // Set order factor for all carts
            $carts = Cart::where('user_id',  $user->id)
            ->whereNull('factor')->get();

            foreach($carts as $cart) {
                $cart->factor = $factor;
                $cart->save();
            }

            $sum = 0;
            foreach($order->getCart($factor) as $cart) {
                $sum += $cart->course->price;
            }   
            $order->total_price = $sum;
            // User id
            $order->user_id = $user->id;
            // Factor
            $order->factor = $factor;

            DB::commit();

            return $this->pay($order);

        } catch(Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    /**
     * Pay order
     *
     * @param Order $order
     * @return mixed
     */
    public function pay(Order $order)
    {
        try {
            // User
            $user = User::find(Auth::user()->id); 
            // Create a new invoice.
            $invoice = new Invoice;
            // Set the invoice amount.
            $invoice->amount(intval($order->total_price . 0));
            $invoice->Uuid($order->factor);
            // $invoice->transactionId('test');
            $invoice->detail(['name', $user->name]);
            $invoice->detail(['phone', $user->phone_number]);
            $invoice->detail(['email', $user->email]);

            $payment = Payment::purchase($invoice, function(
                $driver, $transactionId) use ($order) {
                    // Store transactionId in database, to verify payment in future.
                    $order->transaction_id = $transactionId;
                    // Save order
                    $order->save();
                    // Order status (Not paid yet)
                    $order->statuses()->create(['status' => Status::NOT_PAID]);
                }
            )->pay();

            return response()->json($payment);

        } catch (PurchaseFailedException $exception) {
            return $exception->getMessage();
        }
    }

    // Verify payment
    public function verify(Request $request)
    {
        $order = Order::where('factor', $request->get('order_id'))->first();
        try {
            // Ensure that the invoice has been paid successfully.
            Payment::amount(intval($order->total_price . 0))->transactionId($order->transaction_id)->verify();
            
            // Email
            $user = User::find($order->user_id); // auth('sanctum')->user()->email
            Mail::to($user->email)->send(new SubmittedOrder($order, $order->getCart($order->factor)));

            // You can show payment referenceId to the user.
            // $order->setReciept($receipt->getReferenceId());

            // Order status (Paid)
            $order->statuses()->update(['status' => Status::PAID]);

            return 'پرداخت شما با موفقیت انجام شد';

        } catch (InvalidPaymentException $exception) {
            // When payment is not verified, it will throw an exception.
            return $exception->getMessage();
        }
    }

}
