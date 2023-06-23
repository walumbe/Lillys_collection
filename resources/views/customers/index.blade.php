@extends('admin.layout')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Products</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Register Date</th>
                        <th>Action</th>
                      
                    </tr>
                </thead>
                @foreach($customers as $customer)
                <tbody>
                    <tr>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->created_at}}</td>
                        <td>
                            <form method="" action="">
                                @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>
                            
                        </td>
                    </tr>
                   
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>


@endsection