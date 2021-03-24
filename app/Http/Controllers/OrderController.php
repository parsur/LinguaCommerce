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

    // Submit final order
    public function store() {

        $user_id = Auth::user()->id;

        // Count unpaid order
        $unpaidOrder = Order::where('user_id',  $user_id)->whereHas('statuses', function($query) {
            $query->where('status', Status::VISIBLE);
        })->count();
        // Number of unpaid order
        if($unpaidOrder > 4) {
            return response()->json('شما اجازه داشتن بیش از ۴ سفارش پرداخت نشده ندارید', JSON_UNESCAPED_UNICODE);
        } 
        else {

            DB::beginTransaction();
            try {
                // New order
                $order = new Order();
                // Username
                $order->user_id = $user_id;
                // Count orders where user_id is
                $orderCount = Cart::where('user_id',  $user_id)->count() . 1001;
                // Order factor
                $factor = 'saraRajabi' . $orderCount .  $user_id;
                $order->factor = $factor;

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
                $order->total_price = $sum;

                $order->save();

                // Set order status to be directed
                $orderStatus = $order->statuses()->create(['status' => Status::INVISIBLE]);
                if($orderStatus) {

                    DB::commit();
                    // Email
                    Mail::to(auth()->user()->email)->send(new SubmittedOrder($order, $carts));
                    return Redirect::to('http://heera.it');
                }

            } catch(Exception $e) {
                throw $e;
                DB::rollBack();
            }
        }
    }
}
