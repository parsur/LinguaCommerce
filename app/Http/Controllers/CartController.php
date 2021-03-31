<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\Action;
use App\Models\Cart;
use DB;


class CartController extends Controller
{
    // Show Cart
    public function show() {
        $vars['carts'] = Cart::where('user_id', auth()->user()->id)
            ->whereNull('factor')->get();

        return response()->json($varts);
    }

    // Store
    public function store($course_id,Request $request) {
        // Insert into cart
        Cart::create([
            'course_id' => $course_id,
            'user_id' => auth()->user()->id  
        ]);
        
        return response()->json('اطلاعات با موفقیت به سبد خرید اضافه شد', JSON_UNESCAPED_UNICODE);
    }

    // delete
    public function delete(Action $action,$id) {
        return $action->delete(Cart::class, $id);
    }
}
