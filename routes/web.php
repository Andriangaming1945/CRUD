<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [App\Http\Controllers\authcontroller::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\authcontroller::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
