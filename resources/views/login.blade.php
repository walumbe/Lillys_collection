@extends('layout')

@section('content')

<div class="registration-form">
        <form method="POST" action="/users/authenticate">
            @csrf
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            
           
            <div class="form-group">
                <input type="text" name="email" class="form-control item" id="email" placeholder="Email">
                @error('email')
                    <p class="text-red-500 text-xs mt-1" style="color: red">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name ="password" class="form-control item" id="password" placeholder="Password">
                @error('password')
                    <p class="" style="color: red">{{$message}}</p>
                @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Login</button>
            </div>
        </form>
       
    </div>

@endsection

