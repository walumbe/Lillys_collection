
@extends('layout')

@section('content')

<div class="container " >
   
    <div class="card my-5" style="width: 60rem; margin-top:8rem">
        <div class="card-header">
            <h2>Your Order</h2>
        </div>

        @if(!empty($products))
            

        @foreach($products as $product)
        <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="row">
                <img src="storage/{{$product->product_image}}" style="height: 100px; width:100px" alt="">
                <div class="col">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col">
                            <h3>{{$product->product_name}}</h3>
                            @php
                                $cartItem = \App\Models\CartItem::where('product_id', $product->id)
                                ->where('user_id', auth()->user()->id)
                                ->first();
                            @endphp
                            <p>Quantity: {{$cartItem->quantity}} pcs</p>
                            
                        </div>
    
                        <div class="col ">
                            <span>KES {{$product->price}}</span>
                            <form method="POST" action="/delete-cart-item/{{$product->id}}">
                                @csrf
                                <button type="submit" class="btn btn-danger mt-2">Delete</button>
                            </form>
                            
                        </div>
    
                    </div>
                    
                </div>
                
            </div>
               
            
        </li>
        
        @endforeach
        <li class="list-group-item">
            <div class="row">
                <div class="col">
                    <strong>Total</strong>
                </div>
                <div class="col">
                    
                    KES {{$order->total_price}}
                </div>
            </div>
        </li>
        </ul>
        <div class="card-footer">
            <form method="" action="#">
                @csrf
                <button class="btn btn-primary w-100">Checkout</button>
            </form>
                  
        
        </div>
        @else 
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-center">
                <span><strong>No items in the cart!</strong></span>
            </li>
        </ul>
        @endif
    </div>

</div>

@endsection