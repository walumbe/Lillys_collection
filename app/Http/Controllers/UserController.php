<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mail;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(4);

        return view('home', ['products' => $products]);
    }

    public function show()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('users.index', ['users' => $users]);
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        
        $formFields = $request->validate([
            'name' =>['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => ['required', 'min:12', 'max:12'],
            'password' => 'required|confirmed|min:6'
        ]);

        // hash password
        $formFields['password'] = bcrypt($formFields['password']);
        // create user
        $user = User::create($formFields);
        // login user
        auth()->login($user);

        return redirect('/')->with('success','User created and logged in!' );
        
    }


    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields))
        {
            $request->session()->regenerate();

            $user = auth()->user();

            if ($user->is_admin) {
                return redirect('/admin');
            }

            return redirect('/')->with('success', 'Welcome to Lillys Collection!!🎉');
        }else {
            return redirect('/login')->with('error', 'Invalid Login creentials!')
            ->withErors(['email' => 'Invalid Credentials'])->onlyInput('email');;
        }

    //    return back()->

    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', "You have been logged out!");
    }

    public function forgotPassword()
    {
        return view('forgotPassword');
    }


    public function resetPassword(Request $request)
    {
        $email_input = $request->input('email');

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $user = User::where('email', $email_input)->first();
        
        if(!$user){
            return redirect('/forgot-password')->with('error', 'User with that username does not exist!');
        }

        $token = Str::random(64);
        $user->remember_token = $token;
        $user->save();

        Mail::send('email.forgotPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });


        return back()->with('success', 'We have emailed your password rest link!');

    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $updatePassword = User::where(['email' => $request->email])->first();
        
        if(!$updatePassword)
        {
            return back()->with('error', 'Invalid Token!');
        }

        $user = User::where('email', $request->email)->update(['password' => bcrypt($request->password)]);

        return redirect('/login')->with('success', 'Your password has been changed!');

    }

    public function showResetPasswordForm($token)
    {
        return view('forgottenPasswordLink', ['token' => $token]);
    }
}
