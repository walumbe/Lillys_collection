<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        return view('home', ['products' => Product::all()]);
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
            'phone' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        // hash password
        $formFields['password'] = bcrypt($formFields['password']);
        // create user
        $user = User::create($formFields);
        // login user
        auth()->login($user);

        return redirect('/')->with('message','User created and logged in!' );
        
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

            return redirect('/')->with('message', 'You have been logged in!');
        }

       return back()->withErors(['email' => 'Invalid Credentials'])->onlyInput('email');

    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', "You have been logged out!");
    }
}
