<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/register',[AuthController::class, 'ShowRegisterForms'])->name('registerForms');
Route::post('/register',[AuthController::class, 'Register'])->name('register');

Route::get('/login',[AuthController::class, 'ShowLoginForms'])->name('loginForms');
Route::post('/login',[AuthController::class, 'Login'])->name('login');

Route::get('/dashboard', [UserController::class, 'DashBoard'])->middleware('auth')->name('user.dashboard');

Route::post('/logout', [AuthController::class,'Logout'])->middleware('auth')->name('logout');


Route::middleware(['auth', 'role:0'])->prefix('client')->group(function(){
    Route::get('/dashboard', [ClientController::class, 'DashBoard'])->name('client.dashboard');
    Route::get('/orders', [OrderController::class, 'indexOrdersOfClient'])->name('client.orders');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('client.orders.create');
    Route::post('/orders/create', [OrderController::class, 'store'])->name('client.orders.store');
    Route::get('/orders/{id}', [OrderController::class, 'edit'])->name('client.orders.edit');
    Route::put('/orders/{id}',[OrderController::class, 'update'])->name('client.orders.update');
    Route::delete('/orders/{id}',[OrderController::class, 'destroy'])->name('client.orders.destroy');

});

Route::middleware(['auth', 'role:1'])->prefix('employee')->group(function(){
    Route::get('/dashboard', [EmployeeController::class, 'DashBoard'])->name('employee.dashboard');
    Route::get('/orders', [OrderController::class, 'indexOrdersOfEmployee'])->name('employee.orders');
    Route::get('/orders/{id}', [OrderController::class, 'showForEmployee'])->name('employee.orders.show');
});

Route::middleware(['auth', 'role:2'])->prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'DashBoard'])->name('admin.dashboard');
    Route::get('/orders', [OrderController::class, 'indexOrdersOfAdmin'])->name('admin.orders');
    Route::get('/orders/{id}', [OrderController::class, 'showForAdmin'])->name('admin.orders.show');

});












