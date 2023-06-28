<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // if(!auth()->check())
        // {
        //     return redirect('/login')->with('error', 'You do not have permission to access this page!');
        // }
       
        return view('admin.dashboard');
    }
}
