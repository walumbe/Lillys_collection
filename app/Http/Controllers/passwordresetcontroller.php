<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\user;
use illuminate\support\Facades\Hash;

class passwordresetcontroller extends Controller
{
    public function showResetForm()
{
    return view('passwords.reset');
}

public function update(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|confirmed',
    ]);
    $user = User::where('email', $request->email)->firstOrFail();
    $user->update([
        'password' => Hash::make($request->password),
    ]);
    return redirect()->route('login');
}
}

