<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Status;
use App\Models\User;
use App\Models\Coupon;
use App\Providers\Action;
use App\Mail\SubmittedOrder;
use App\DataTables\OrderDataTable;
use App\Http\Controllers\CartController;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Auth;

class OrderController extends Controller
{   
    // Facing any error, fix here
    public function __construct() {
        $this->middleware(['auth:sanctum', 'verified'])->except(['list', 'orderTable', 'details', 'verify']);
    }

    // Datatable To blade
    public function list() {
        
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
    public function delete(Action $action, $id) {
        return $action->delete(Order::class, $id);
    }

    // Show the user's carts
    public function showCart(CartController $cart) {
        return $cart->show();
    }

    // Show the users's orders
    public function showOrder() {
        $vars['orders'] = Order::where('user_id', auth()->user()->id)->select('id','factor', 'total_price')
                            ->with('user:name,phone_number,email', 'statuses:status_id,status')->get();

        return response()->json($vars);
    }

    // Details
    public function details(Request $request) {
        // Each order 
        $vars['order'] = Order::where('factor', $request->get('factor'))
                            ->with('statuses:status_id,status')->first();
        // Cart
        if($vars['order']->statuses->status == Status::PAID) {
            $vars['orderCourses'] = Cart::where('factor', $request->get('factor'))->select('course_id')->with(['course' => function($query) {
                $query->select('id', 'name', 'price')->with('files:course_id,title,url');
            }])->get();
        }

        if($request->has('admin'))
            return view('order.details', $vars);

        return response()->json($vars);
    }

    // Submit final order
    public function store(Request $request) {
        // User
        $user = User::find(Auth::user()->id); 

        $order = new Order();

        // Number of unpaid orders
        if($order->hasExceededOrder()) {
            return $this->failedResponse('شما اجازه داشتن بیش از چهار سفارش پرداخت نشده ندارید', Response::HTTP_FORBIDDEN);
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

        // Summation
        $summation = 0;
        foreach($order->getCart($factor) as $cart) {
            $summation += $cart->course->price;
        } 
        
        // Coupon code
        if($request->has('coupon_code')) {

            $coupon = Coupon::where('code', $request->get('coupon_code'))->first();
            $summation = $coupon->discount($summation);
        }

        $order->total_price = $summation;
        // User id
        $order->user_id = $user->id;
        // Factor
        $order->factor = $factor;

        return $this->pay($order);
    }

    // Complete the unpaid order
    public function completeUnpaidOrder(Request $request) {
        
        $order = Order::find($request->get('id'));
        
        return $this->pay($order);
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
            // Set the invoice.
            $invoice = new Invoice;
            $invoice->amount(intval($order->total_price . 0));
            $invoice->Uuid($order->factor);

            // Payment
            $payment = Payment::purchase($invoice, function (
                $driver, $transactionId) use ($order) {
                    // Store transaction id in database, to verify payment in future.
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
    public function verify(Request $request) {

        $order = Order::where('factor', $request->get('order_id'))->first();
        try {
            // Ensure that the invoice has be en paid successfully.
            Payment::amount(intval($order->total_price . 0))->transactionId($order->transaction_id)->verify();
            
            // Email
            $user = User::find($order->user_id); 
            Mail::to($user->email)->send(new SubmittedOrder($order, $order->getCart($order->factor)));

            // Order status (Paid)
            $order->statuses()->update(['status' => Status::PAID]);

            return view('order.verification', ['success' => 'پرداخت شما با موفقیت انجام شد']);

        } catch (InvalidPaymentException $exception) {
            // When payment is not verified, it will throw an exception.
            return view('order.verification', ['error' =>  $exception->getMessage()]);
        }
    }
}
