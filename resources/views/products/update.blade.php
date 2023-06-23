@extends('admin.layout')

@section('content')


        <form method="POST" action="/products/{{$product->id}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
            <div class="form-group">
                <input type="file" name="product_image" value="" class="form-control" placeholder="Product Image">
                <img src="{{asset('storage/'.$product->product_image)}}" alt="">
                @error('product_image')
                 <p style="color: red;">{{$message}}</p> 
              @enderror
              </div>
            <div class="form-group">
              <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" placeholder="Product Name">
              @error('product_name')
                 <p style="color: red;">{{$message}}</p> 
              @enderror
            </div>
            <div class="form-group">
              <textarea class="form-control" name="description" value="{{ $product->description }}" rows="2" placeholder="Description"></textarea>
              @error('description')
              <p style="color: red;">{{$message}}</p>
              @enderror
            </div>
            <div class="form-group">
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" placeholder="Product Price">
                @error('price')
                 <p style="color: red;">{{$message}}</p> 
              @enderror
              </div>
            <div class="form-group">
                <button type='submit' class="btn btn-primary">Submit</button>
            </div>
        </form>

@endsection