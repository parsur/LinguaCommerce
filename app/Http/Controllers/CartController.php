<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\Action;
use App\Providers\CartAction;
use App\Models\Cart;
use DB;


class CartController extends Controller
{
    // Show Cart
    public function show(CartAction $cart) {
        return $cart->show('=');
    }

    // Store
    public function store(Request $request) {
        // Insert into cart
        Cart::create([
            'course_id' => $request->get('course_id'),
            'user_id' => auth()->user()->id  
        ]);
        
        return response()->json(['success' => 'اطلاعات با موفقیت به سبد خرید اضافه شد'], 200);
    }

    // delete
    public function delete(Action $action,$id) {
        return $action->delete(Cart::class, $id);
    }
}
