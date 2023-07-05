@extends('layout')

@section('content')

<div class="registration-form">
        <form method="POST" action="/users">
            @csrf
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
                <input type="text" name="name" class="form-control item" id="name" placeholder="Name" value="{{old('name')}}">
                @error('name')
                    <p class="" style="color: red">{{$message}}</p>
                @enderror
            </div>
           
            <div class="form-group">
                <input type="email" name="email" class="form-control item" id="email" placeholder="Email" value = "{{old('email')}}">
                @error('email')
                    <p class="" style="color: red">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name = "phone" class="form-control item" id="phone-number" placeholder="2547XXXXXXXX" value="{{old('phone')}}">
                @error('phone')
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
                <button type="submit" class="btn btn-block create-account">Create Account</button>
            </div>

            <span style="margin-top: 10px">Already have an account? Login <a href="/login">here.</a> </span>
        </form>
       
    </div>

@endsection

