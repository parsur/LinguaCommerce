<?php

namespace App\Providers;
use App\Models\Cart;

class CartAction {

    /**
     * Action of cart. (GET,POST)
     * 
     * @return json 
     */
    
    // Show Cart
    public function show($operator) {
        $user_id = auth()->user()->id;

        $vars['carts'] = Cart::where('user_id', $user_id)
            ->where('factor', $operator, null)->with('course:id,name,price')->get();
        
        $vars['count'] = Cart::where('user_id', $user_id)
            ->where('factor', $operator, null)->count();

        return response()->json($vars);
    }
}