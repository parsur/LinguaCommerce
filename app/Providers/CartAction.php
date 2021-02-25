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
    

    // Visible
    public function visible() {

        $carts = Cart::where('user_id', Auth::user()->id)
            ->whereHas('statuses', function($query) {
                $query->where('status', Status::VISIBLE);
            })->get();

        return response()->json($carts);
    }
}