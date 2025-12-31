<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/register',[ClientController::class, 'create'])->name('client.create');
Route::post('/register',[ClientController::class, 'store'])->name('client.store');
