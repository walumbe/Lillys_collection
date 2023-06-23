@extends('admin.layout')

@section('content')

<!-- Page Heading -->
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3  text-gray-800">Products</h1>
    <a href="/create-product"><button class="btn btn-primary">Create Product</button></a>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Products</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($products as $product)
                <tbody>
                    <tr>
                            <td>{{ $product->id }}</td>
                            <td><img style="height: 50px; width:50px;" src={{asset('storage/'.$product->product_image)}} alt=""></td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->description }}</td>
                            <td> KES {{ $product->price }}</td>
                            <td>
                                <div class="justify-space-between">
                                    <a href="/products/{{$product->id}}/edit"><i class="fa fa-edit text-primary"></i></a>

                                    <form method="POST" action="/products/{{$product->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none; background-color: transparent;">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </form>                                    
                                    
                                </div>
                            </td>
                    </tr>
                    
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>
    
@endsection