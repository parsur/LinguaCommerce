<?php

namespace App\Providers;
use App\Models\Cart;
use App\Models\Status;

class CartAction {

    /**
     * Visible or invisible cart.
     * 
     * @return json 
     */
    

    // Visiblity
    public function visible() {

        $carts = Cart::where('user_id', Auth::user()->id)
            ->where('order_factor', null)->get();

        return response()->json($carts);
    }
}