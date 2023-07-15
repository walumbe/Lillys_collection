@extends('layout')

@section('content')

<div class="registration-form">
        <form method="POST" action="/users/authenticate">
            @csrf
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            
           
            <div class="form-group">
                <input type="text" name="email" class="form-control item" id="email" placeholder="Email" value="{{old('email')}}">
                @error('email')
                    <p class="text-red-500 text-xs mt-1" style="color: red">{{$message}}</p>
                @enderror
            </div>
            <span class="my-2">forgot password? reset password </span><a href="/password/reset">here</a>
            <div class="form-group">
                <input type="password" name ="password" class="form-control item" id="password" placeholder="Password">
                @error('password')
                    <p class="" style="color: red">{{$message}}</p>
                @enderror
            </div>
            
            <div class="form-group d-flex justify-space-between">
                <button type="submit" class="btn btn-block create-account">Login</button>

            </div>

            <span class="my-2">Don't have an account? Register </span><a href="/register">here</a><br>
<<<<<<< HEAD
            

=======
            <span style=""><a href="/forgot-password">Forgot Password?</a></span>
>>>>>>> 279e8cb2b04a0d287ca706f5e5e3249f490cbee5
            
        </form>
       
    </div>

@endsection

