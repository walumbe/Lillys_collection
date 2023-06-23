@extends('admin.layout')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-uppercase">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                @foreach($users as $user)
                <tbody>
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td></td>
                    </tr>
                
                   
                </tbody>
                @endforeach
                
            </table>
        </div>
    </div>
</div>

@endsection