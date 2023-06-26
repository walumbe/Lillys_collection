<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;

class CartItemController extends Controller
{
    public function index(Product $product)
    {
        if(!auth()->check()) 
        {
            return redirect('/login');
        }
        $user_id = auth()->user()->id;
        $cartItems = CartItem::where('user_id', $user_id)->get();
        $products = [];
        $total = 0;
        $quantity = 0;
        foreach($cartItems as $cartItem)
        {
            $products[] = Product::where('id', $cartItem->product_id)->first();
            $quantity = $cartItem->quantity;
        }
      
        $cart= CartItem::where('user_id', $user_id)->first();
        $product = Product::where('id', $cart->product_id)->first();
        $cartItem = CartItem::where('product_id', $product->id)->first();


        return view('cart.index', ['products' => $products, 'total' => $total, 'cartItem' => $cartItem]);
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
            // return redirect('/')->with('success', "Quantity Incremented successfully!");
            session()->flash('message', 'Quantity Incremented successfully!');
        }else {
            $cart = new CartItem();
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->quantity = 1;
            $cart->price = $product->price;
            $cart->save();
            session()->flash('message', 'Product added to cart!');
            return redirect('/');
        }

        // return redirect('/')->with('success', "Product added to cart!");
    }


    public function updateQuantity(Request $request, Product $product)
    {
        $cartItem = CartItem::where('product_id', $product->id)
        ->where('user_id', auth()->user()->id)
        ->first();
        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();
    
        return redirect('/cart');
    }


    public function deleteCartItem(Product $product)
    {
        $cartItem = CartItem::where('product_id', $product->id)->first();
        $cartItem->delete();
    
        return redirect('/cart')->with('cartItem', $cartItem);
    }
    
    

}
