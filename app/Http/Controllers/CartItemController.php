<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;

class CartItemController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $cartItems = CartItem::where('user_id', $user_id)->get();
        $products = [];
        $total = 0;
        foreach($cartItems as $cartItem)
        {
            $products[] = Product::where('id', $cartItem->product_id)->first();
        }
        return view('cart.index', ['products' => $products, 'total' => $total]);
    }
    public function addToCart(Request $request, Product $product)
    {
        if(!auth()->check())
        {
            return redirect('/login');
        }

        // current user cart 
        $cart = CartItem::where('user_id', auth()->user()->id)
        ->where('product_id', $product->id)
        ->first();

        if($cart) {
            $cart->quantity += $request->post('quantity');
            $cart->save();
            session()->flash('success', 'The quantity of the product has been updated.');
        }else {
            $cart = new CartItem();
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->quantity = $request->post('quantity');
            $cart->save();
            session()->flash('success', 'Product added to cart!');
        }

        return redirect('/')->with('message', 'Product added to cart!');
    }
}
