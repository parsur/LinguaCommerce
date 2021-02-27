<?php

namespace App\Providers;
use App\Models\Cart;
use App\Models\Order;

class CartAction {

    /**
     * Visible or invisible cart.
     * 
     * @return json 
     */
    

    // Visible
    public function visible() {

        $carts = Cart::where('user_id', auth()->user()->id)
            ->whereNull('order_factor')->get();

        return response()->json($carts);
    }

}