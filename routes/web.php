<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\ActionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [App\Http\Controllers\authcontroller::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\authcontroller::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [AccountController::class, 'index'])->name('dashboard');
    Route::resource('akun', AccountController::class)
        ->only(['store', 'update', 'destroy'])
        ->parameters(['akun' => 'user']);

    
    Route::get('/tipe-akun', [AccountTypeController::class, 'index'])->name('tipe-akun.index');
    Route::resource('tipe-akun', AccountTypeController::class)
    ->only(['store', 'update', 'destroy'])
    ->parameters(['tipe-akun' => 'accountType']);

    Route::get('/jenis-aksi', [ActionsController::class, 'index'])->name('jenis-aksi.index');
    Route::resource('jenis-aksi', ActionsController::class)
    ->only(['store', 'update', 'destroy']);
});