<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class OrderController extends Controller
{
    public function checkout()
    {
        $user_id = auth()->user()->id;
        $cartItems = CartItem::where('user_id', $user_id)->get();
        $order = new Order();
        $order->user_id = $user_id;
        $order->status = 'UNPAID';
        $order->products = json_encode($cartItems);
        $totalSum = DB::table('cart_items')
            ->selectRaw('SUM(subtotal) AS total_price')
            ->first();

        $order->total_price = $totalSum->total_price;
        $order->save();

        $customer_order = Order::where('user_id', $user_id)->get();

        $user_id = auth()->user()->id;
        $products = null;
    
        foreach ($cartItems as $item) {
            $products[] = Product::where('id', $item->product_id)->first();
    
        }

        return view('checkout', ['products' => $products, 'order' => $customer_order] );
    }


    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('orders.index', ['orders' => $orders]);    
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect('/orders')->with('success', 'Order deleted successfully!');
    }
}
