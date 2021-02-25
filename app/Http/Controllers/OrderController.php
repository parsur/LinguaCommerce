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
use Auth;

class OrderController extends Controller
{
    // Datatable To blade
    public function list() {
        // dataTable
        $dataTable = new OrderDataTable();

        // Order table
        $vars["orderTable"] = $dataTable->html();

        return view('order.orderList', $vars);
    }

    // Get order
    public function orderTable(OrderDataTable $dataTable) {
        return $dataTable->render('order.orderList');
    }

    // delete
    public function delete(Action $action,$id) {
        return $action->delete(Order::class, $id);
    }

    // Show User's orders
    public function show(CartAction $cart) {
        $cart->visible();
    }

    // Submit final order
    public function store() {
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

        $order->save();
        
        return response()->json($orderCount);
    }


}
