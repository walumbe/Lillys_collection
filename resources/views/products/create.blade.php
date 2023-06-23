@extends('admin.layout')

@section('content')


        <form method="POST" action="/store-product" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <input type="file" name="product_image" class="form-control"  placeholder="Product Image">
                @error('product_image')
                 <p style="color: red;">{{$message}}</p> 
              @enderror
              </div>
            <div class="form-group">
              <input type="text" name="product_name" class="form-control" value="{{old('product_image')}}" placeholder="Product Name">
              @error('product_name')
                 <p style="color: red;">{{$message}}</p> 
              @enderror
            </div>
            <div class="form-group">
              <textarea class="form-control" name="description" value="{{old('description')}}" rows="2" placeholder="Description"></textarea>
              @error('description')
              <p style="color: red;">{{$message}}</p>
              @enderror
            </div>
            <div class="form-group">
                <input type="number" name="price" class="form-control" value="{{old('price')}}" placeholder="Product Price">
                @error('price')
                 <p style="color: red;">{{$message}}</p> 
              @enderror
              </div>
            <div class="form-group">
                <button type='submit' class="btn btn-primary">Submit</button>
            </div>
        </form>

@endsection