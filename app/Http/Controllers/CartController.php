<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Providers\Action;
use App\Providers\CartAction;
use App\Models\Cart;
use DB;


class CartController extends Controller
{
    // Show Cart
    public function show(CartAction $cart) {
        $user_id = auth()->user()->id;

        $vars['carts'] = Cart::where('user_id', $user_id)
            ->whereNull('factor')->with('course:id,name,price')->get();
        
        $vars['count'] = Cart::where('user_id', $user_id)
            ->whereNull('factor')->count();

        return response()->json($vars);
    }

    // Store
    public function store(Request $request) {
        // Insert into cart
        Cart::create([
            'course_id' => $request->get('course_id'),
            'user_id' => auth()->user()->id  
        ]);
        
        return response()->json(['success' => 'اطلاعات با موفقیت به سبد خرید اضافه شد'], Response::HTTP_CREATED);
    }

    // delete
    public function delete(Action $action,$id) {
        return $action->delete(Cart::class, $id);
    }
}
