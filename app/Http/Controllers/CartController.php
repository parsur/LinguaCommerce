<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCartRequest;
use App\Providers\Action;
use App\Providers\CartAction;
use App\Models\Cart;
use DB;


class CartController extends Controller
{
    // Show Cart
    public function show() {
        $user_id = auth()->user()->id;

        $vars['carts'] = Cart::where('user_id', $user_id)
            ->whereNull('factor')->with('course:id,name,price')->get();

        // Count
        $vars['count'] = $vars['carts']->count();

        // Total price
        $vars['total_price'] = 0;
        
        foreach($vars['carts'] as $cart) {
            $vars['total_price'] += $cart->course->price;
        }

        return response()->json($vars);
    }

    // Store
    public function store(StoreCartRequest $request) {
        // Insert into cart
        Cart::create([
            'course_id' => $request->get('course_id'),
            'user_id' => auth()->user()->id  
        ]);
        
        return $this->responseWithSuccess('اطلاعات با موفقیت به سبد خرید اضافه شد');
    }

    // delete
    public function delete(Action $action,$id) {
        return $action->delete(Cart::class, $id);
    }
}
