<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartItemController extends Controller
{
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
            $cart->quantity++;
            $cart->subtotal = $cart->quantity * $cart->price;
            $cart->save();
            return back()->with('success', 'Quantity Incremented successfully!');
        }else {
            $cart = new CartItem();
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->quantity = 1;
            $cart->price = $product->price;
            $cart->subtotal = $cart->price;
            $cart->save();
            
        }
        return back()->with('success', 'Product added to cart!');
       
    }
    public function index(Product $product)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }
    
        $user_id = auth()->user()->id;
        $cartItems = CartItem::where('user_id', $user_id)->get();
        $products = null;
    
        foreach ($cartItems as $item) {
            $products[] = Product::where('id', $item->product_id)->first();
    
        }
    
        return view('cart.index', ['products' => $products]);
    }
    
 


    public function updateQuantity(Request $request, Product $product)
    {
        $user_id = auth()->user()->id;
        $cartItem = CartItem::where('product_id', $product->id)
        ->where('user_id', $user_id)
        ->first();
        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();
    
        return redirect('/cart');
    }


    public function deleteCartItem(Product $product)
    {
        $cartItem = CartItem::where('product_id', $product->id)->first();
        $cartItem->delete();
    
        return redirect('/cart')->with('success', 'Cart Item deleted Successfully!');
    }
    
    

}
