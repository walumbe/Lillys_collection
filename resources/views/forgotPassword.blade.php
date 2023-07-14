@extends('layout')

@section('content')

<div class="container p-5 ">
    <div class="mx-2 card text-center my-5" style="width: 300px;">
        <div class="card-header h5 text-white bg-primary">Password Reset</div>
        <div class="card-body px-5">
            <p class="card-text py-2">
                Enter your email address and we'll send you an email with instructions to reset your password.
            </p>
            <form action="/reset-password" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="typeEmail">Email</label>
                    <input type="email" name="email" class="form-control my-3" required/>
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    
                </div>
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
        </div>
    </div>
    
</div>


@endsection