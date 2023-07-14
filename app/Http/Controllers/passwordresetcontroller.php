<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function resetpassword()
    {
        return view('reset');
    }
    public function resetpasswordpost(request $request)
    {
       $request->validate([
        'email'=>"required|email|exists:users",
       ]);

       $token =Str::random(255);

       DB::table('password_resets')->update([
        'email'=>$request->email,
        'token'=>$token,
        'created_at'=>Carbon::now()
       ]);

       Mail::send("emails/forget-password",['token'=>$token], function($message)
       use ($request){
        $message->to($request->email);
        $message->subject("reset password");


       });

       return redirect('/reset')->with('success', 'we have send an email to reset password.');
    }

  public function forgetpassword($token)
  {
    return view('new-password', compact('token'));
  }

public function forgetpasswordpost(request $request)
 {
    $request->validate([
        "email"=>"required|email|exists:users",
        "password"=>"required|string|min:8|confirmed",
        "confirm password" =>"required"
    ]);
    $updatepassword = DB::table('password_resets')
    ->where([
        "email"=>$request->email,
        "token"=>$request->token

    ])->first();

    if(!$updatepassword)
    {
        return redirect('/reset-password')->with("error", "invalid");
    }
    User::where("email",$request->email)
    ->update(["password" =>Hash::make($request->password)]);
    DB::table("password_resets")->where(["email" => $request->email])->delete();

    return redirect('/login')->with("success","password reset successfull");

 }
}

