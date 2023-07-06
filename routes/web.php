<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\passwordresetcontroller;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\PasswordReset;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/home', function() {
//     return redirect('/');
// });
Route::get('/', [UserController::class, 'index']);

Route::get('admin', [AdminController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);

Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::get('/login', [UserController::class, 'login'])->middleware('guest');

// Route::prefix('/admin')->group(function(){
    // Admin view
    // Route::get('/admin', [AdminController::class, 'index'])->middleware('guest');
    // Route::get('/products', [ProductController::class, 'index']);
// });
// create new user
Route::post('/users', [UserController::class, 'store']);
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/password/reset', [passwordresetcontroller::class, "resetpassword"])-> name("forgetpassword");
Route::post('/password/reset', [passwordresetcontroller::class, "resetpasswordpost"])-> name("forget.password.post");
// display add product form
Route::get('/create-product', [ProductController::class, 'create']);
Route::post('/store-product', [ProductController::class, 'store']);
Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
Route::put('/products/{product}', [ProductController::class, 'update']);
Route::delete('/products/{product}', [ProductController::class, 'delete']);

Route::get('/endusers',[UserController::class, 'show']);
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth');

// cart items
Route::post('/cart/add/{product}', [CartItemController::class, 'addToCart']);
Route::get('/cart', [CartItemController::class, 'index']);

Route::post('/update-quantity/{product}', [CartItemController::class, 'updateQuantity']);
Route::post('/delete-cart-item/{product}', [CartItemController::class, 'deleteCartItem']);

// checkout
Route::get('/checkout', [OrderController::class, 'checkout']);

// Orders
Route::get('/orders', [OrderController::class, 'index']);

Route::post('/orders/{order}', [OrderController::class, 'destroy']);


