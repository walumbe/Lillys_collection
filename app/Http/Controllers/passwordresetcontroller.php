<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\user;
use Illuminate\Auth\Notifications\ResetPassword;
use illuminate\support\Facades\Hash;

class passwordresetcontroller extends Controller
{
    public function resetpassword()
{
    return view('passwords/reset');
}
 function resetpasswordpost(request $request){

 }
}

