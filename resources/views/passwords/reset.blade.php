@extends('layout')

@section('content')
<main>
<div class="registration-form">
    <p>will send a link to your email, use that link to reset password.</p>
        <form method="POST" action="{{route('forget.password.post')}}">
            @csrf
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            
           
            <div class="form-group">
                <input type="text" name="email" class="form-control item" id="email" placeholder="Email">
                @error('email')
                    <p class="text-red-500 text-xs mt-1" style="color: red">{{$message}}</p>
                @enderror
            
                <div class="form-group d-flex justify-space-between">
                <button type="submit" class="btn btn-block create-account">submit</button>

            </div>
        </form>
       
    </div>
 </main>
@endsection

