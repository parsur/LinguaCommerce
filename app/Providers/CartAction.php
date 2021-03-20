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
    

    // Carts have not gone to order.
    public function visible() {

        $carts = Cart::where('user_id', auth()->user()->id)
            ->whereNull('factor')->get();

        return response()->json($carts);
    }

}