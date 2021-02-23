<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Providers\Action;


class CartController extends Controller
{
    // Show Cart
    public function index() {
        $carts = Cart::where('order_factor', null)->where('user_id', Auth::user()->id)->get();
        return response()->json($carts);
        // foreach($carts as $cart) {
        //     print($cart->course);
        // }
    }

    // Store
    public function store($course_id,EnglishConvertion $englishConvertion,Request $request) {

        // Insert into cart
        $cart = Cart::create([
            'course_id' => $course_id,
            'user_id' => Auth::user()->id,
            'order_factor' => $request->get('order_factor'),
            'count' => $englishConvertion->convert($request->get('count'))
        ]);

        return response()->json('اطلاعات با موفقیت انجام شد.');
    }

    // delete
    public function delete(Action $action,$id) {
        return $action->delete(Cart::class, $id);
    }
}
