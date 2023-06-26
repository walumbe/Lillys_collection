@extends('layout')

@section('content')

<div class="container " >
   
    <div class="card my-5" style="width: 60rem; margin-top:8rem">
        <div class="card-header">
            <h2>Your Cart Items</h2>
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
                        </div>
    
                        <div class="col ">
                            <span>KES {{$product->price}}</span>
                            <form method="POST" action="/delete-cart-item/{{$product->id}}">
                                @csrf
                                <button type="submit" class="btn btn-danger mt-2">Delete</button>
                            </form>
                            
                        </div>

                        <?php # $total += $product->price ?>
    
                    </div>
                    <div class="row">
                        <div class="row">
                            {{-- <form method="POST" action="/update-quantity/{{$product->id}}">
                                @csrf
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input name ="quantity" type="number" value="" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Update Quantity</button>
                                
                            </form> --}}
                            
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
                    <p>Shipping and taxes calculated at checkout.</p>
                </div>
                <div class="col">
                    
                    KES Total
                </div>
            </div>
        </li>
        </ul>
        <div class="card-footer">
                <button type="submit" class="btn btn-primary w-100">Proceed to checkout</button>  
        
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