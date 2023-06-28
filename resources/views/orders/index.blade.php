<?php
use App\Models\User;
?>
@extends('admin.layout')

@section('content')

<!-- Page Heading -->
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3  text-gray-800">Orders</h1>
   
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($orders as $order)
                <tbody>
                    <?php $user = User::where('id', $order->user_id)->first(); ?>
                    <tr>
                            <td>{{ $order->id }}</td>
                            <td><?= $user->name ?></td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <div class="justify-space-between">
                                    {{-- <a href=""><i class="fa fa-edit text-primary"></i></a> --}}

                                    <form method="" action="/orders/{{$order->id}}">
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

            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item {{ $orders->currentPage() === 1 ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
                </li>
                @for ($i = 1; $i <= $orders->lastPage(); $i++)
                    <li class="page-item {{ $orders->currentPage() === $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ $orders->currentPage() === $orders->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
                </li>
            </ul>
            </nav>

            
        </div>
    </div>
</div>
    
@endsection