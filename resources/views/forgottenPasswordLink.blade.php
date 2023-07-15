@extends('layout')
@section('content')
    <div class="registration-form">
        <form method="POST" action="/submit-reset-password">
            @csrf
            
            <div class="form-group">
                <input type="email" name="email" class="form-control item" id="email" placeholder="Email" value = "{{old('email')}}">
                @error('email')
                    <p class="" style="color: red">{{$message}}</p>
                @enderror
            </div>
            
            <div class="form-group">
                <input type="password" name ="password" class="form-control item" id="password" placeholder="Password">
                @error('password')
                    <p class="" style="color: red">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name ="password_confirmation" class="form-control item" id="password" placeholder="Confirm Password">
                @error('password')
                    <p class="" style="color: red">{{$message}}</p>
                @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Reset Password</button>
            </div>
        </form>
        
    </div>
@endsection 