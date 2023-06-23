@extends('layout')

@section('content')

<div class="container " >
   
    <div class="card my-5" style="width: 60rem;">
        <div class="card-header">
            <h2>Your Cart Items</h2>
        </div>

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
    
                        <div class="col mr-0">
                            <span>KES {{$product->price}}</span>
                        </div>

                        <?php $total += $product->price ?>
    
                    </div>
                    <div class="row">
                        <form method="POST" action="">
                        
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input name ="quantity" type="number">
                            </div>
                            
                        </form>
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
                    
                    KES {{$total}}
                </div>
            </div>
        </li>
        </ul>
        <div class="card-footer">
        <button class="btn btn-primary w-100">Proceed to checkout</button>
        </div>
    </div>

</div>

@endsection