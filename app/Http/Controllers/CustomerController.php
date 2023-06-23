<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('is_admin', false)->get();
        return view('customers.index', ['customers' => $customers]);
    }
}
