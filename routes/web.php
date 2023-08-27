<?php

use App\Http\Controllers\Orders\OrdersController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Sinube\SinubeController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('admin')->controller(ProductsController::class)
->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/products','index')->name('products.index');
    Route::get('/products/export','export')->name('products.export');
    Route::get('/products/async','asyncProductsBySinube')->name('products.async');
});

Route::prefix('admin')->controller(OrdersController::class)
->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/orders','index')->name('orders.index');
    Route::get('/orders/export','export')->name('orders.export');
    Route::post('/orders/create','createOrder')->name('orders.create');
});

Route::prefix('admin')->controller(SinubeController::class)
->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/sinube','consultar')->name('sinube.query');
});

Route::prefix('admin')->controller(UsersController::class)
->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/users','index')->name('users.index');
    Route::post('/users/create','create')->name('users.create');
    Route::get('/users/update','asyncProductsBySinube')->name('users.async');
    Route::get('/users/delete','asyncProductsBySinube')->name('users.async');
});
Route::view('/register', 'auth.register')->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


