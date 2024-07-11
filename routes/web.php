<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [EventsController::class, 'index']);
// Route::post('/users')
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'authenticate']);
Route::get('/register', [UserController::class, 'register']);
Route::post('/register', [UserController::class, 'doRegister']);

Route::get('/user/dashboard', [DashboardController::class, 'dashboard'])->middleware('middleware.guest')->name('dashboard');


Route::get('/users/products/{productId}', [ProductController::class, 'getDetailProduct' ])->middleware('middleware.guest')->where('productId', '[0-9]+');
Route::post('/users/orders', [OrderController::class, 'createOrder']);
// Route::get('/users/products', [DashboardController::class, 'getAllProduct'])->middleware('middleware.guest')->name('getAllProduct');
