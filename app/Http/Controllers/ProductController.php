<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(6);
        return view("products.index", ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $formFields = $request->validate([
            'product_name' => 'required',
            'description' => ['required', 'max:255'],
            'price' => 'required'
        ]);
        if($request->hasFile('product_image'))
        {
            $formFields['product_image'] = $request->file('product_image')->store('images', 'public');
        }
        // $formFields['created_by'] = auth()->id();

        Product::create($formFields);

        return redirect('/products')->with('message', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        return view('products.update', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        // if($product->created_by != auth()->id())
        // {
        //     abort(403, 'Unathorised action');
        // }
        $formFields = $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if($request->hasFile('product_image'))
        {
            $formFields['product_image'] = $request->file('product_image')->store('images', 'public');
        }

        $product->update($formFields);

        return redirect('/products')->with('message', 'Product Updated successfully!');
    }

    public function delete(Product $product)
    {
        // if($product->created_by != auth()->user())
        // {
        //     abort(403, 'Unauthorised action.');
        // }
        $product->delete();
        return redirect('/products')->with('message', 'Product deleted Successfully!');
    }
}
