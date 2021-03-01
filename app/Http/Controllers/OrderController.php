<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\Action;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use App\Models\Status;
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
            ->whereNotNull('order_factor')->get();

        return response()->json($orders);
    }

    // Details
    public function details(Request $request) {

        // Each order
        $vars['order'] = Order::where('order_factor', $request->get('order_factor'))->first();
        // Cart
        $vars['carts'] = Cart::where('order_factor', $request->get('order_factor'))->get();

        return view('order.details', $vars);
    }

    // Submit final order
    public function store() {

        DB::beginTransaction();

        try {
            // New order
            $order = new Order();
            // Username
            $order->user_id = 29;
            // Count order where user_id is
            $orderCount = Cart::where('user_id', 29)->count() . 1001;
            // Order factor
            $order_factor = 'saraRajabi' . $orderCount . 29;
            $order->order_factor = $order_factor;

            // Set all carts order_factor
            $cartProducts = Cart::where('user_id', 29)
                ->where('order_factor', null)->get();

            foreach($cartProducts as $cartProduct) {
                $cartProduct->order_factor = $order_factor;
                $cartProduct->save();
            }

            // Course total price
            $sum = 0;
            $cartPrices = Cart::where('order_factor', $order_factor)->get();
            foreach($cartPrices as $cartPrice) {
                $sum += $cartPrice->course->price;
            }
            $order->total_price = $sum;

            // Set order status to be directed
            $orderStatus = $order->statuses()->create(['status' => 1]);
            if($orderStatus) {
                return Redirect::to('http://heera.it');
            }

            $order->save();

            DB::commit();

        } catch(Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
