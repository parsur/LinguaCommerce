<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\Action;
use App\Models\Order;
use App\Models\Cart;
use App\Providers\CartAction;
use App\DataTables\OrderDataTable;
use Illuminate\Support\Facades\Redirect;
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
    public function showCart(CartAction $cart) {
        $cart->visible();
    }

    // Show users's order
    public function showOrder() {
        $orders = Order::where('user_id', auth()->user()->role)
            ->whereNotNull('factor')->get();

        return response()->json($orders);
    }

    // Details
    public function details(Request $request) {

        // Each order
        $vars['order'] = Order::where('factor', $request->get('factor'))->first();
        // Cart
        $vars['carts'] = Cart::where('factor', $request->get('factor'))->get();

        return view('order.details', $vars);
    }

    // Submit final order
    public function store() {

        DB::beginTransaction();
        $user_id = Auth::user()->id;

        try {
            // New order
            $order = new Order();
            // Username
            $order->user_id =  $user_id;
            // Count order where user_id is
            $orderCount = Cart::where('user_id',  $user_id)->count() . 1001;
            // Order factor
            $factor = 'saraRajabi' . $orderCount .  $user_id;
            $order->factor = $factor;

            // Set order factor for all carts
            $cartProducts = Cart::where('user_id',  $user_id)
                ->where('factor', null)->get();

            foreach($cartProducts as $cartProduct) {
                $cartProduct->factor = $factor;
                $cartProduct->save();
            }

            // Course total price
            $sum = 0;
            $cartPrices = Cart::where('factor', $factor)->get();
            foreach($cartPrices as $cartPrice) {
                $sum += $cartPrice->course->price;
            }
            // Total price
            $order->total_price = $sum;

            $order->save();

            // Set order status to be directed
            $orderStatus = $order->statuses()->create(['status' => 1]);
            if($orderStatus) {

                DB::commit();
                // Payment Gateway
                return Redirect::to('http://heera.it');
            }

        } catch(Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
