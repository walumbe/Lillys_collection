@extends('layout') 

@section('content')
<div class="card">
 <div class="card-header">{{_{'reset password'}}}</div>
    <div class="card-body">
        <form method="POST" action="{{route{'password.update'} }}">
          @csrf

          <input type="hidden" name="token" value="{{$token}}">
          <div class="form-group">
             <input type="email" name="email" placeholder="Email">
             @error('email')
                    <p class="text-red-500 text-xs mt-1" style="color: red">{{$message}}</p>
                @enderror
             <input type="password" name="password" placeholder="new password">

             <input type="password" name="password" placeholder="confirm password">
             @error('password')
                    <p class="text-red-500 text-xs mt-1" style="color: red">{{$message}}</p>
                @enderror
              <button type="submit">Reset Password</button>
          </div>
        </form>
    </div>
</div>