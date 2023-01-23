<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return auth()->check() ? redirect('/home') : view('welcome');
});

Route::get('/home', [\App\Http\Controllers\AccountController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::get('/crypto', [\App\Http\Controllers\CryptoController::class, 'index'])->middleware(['auth', 'verified'])->name('crypto');
Route::get('/crypto/{symbol}', [\App\Http\Controllers\CryptoController::class, 'show'])->middleware(['auth', 'verified'])->name('crypto.show');

Route::get('/account/{account}/edit', [\App\Http\Controllers\AccountController::class, 'edit'])->middleware(['auth', 'verified'])->name('accounts.edit');
Route::put('/account/{account}/edit', [\App\Http\Controllers\AccountController::class, 'update'])->middleware(['auth', 'verified'])->name('accounts.update');
Route::get('/account/create', [\App\Http\Controllers\AccountController::class, 'create'])->middleware(['auth', 'verified'])->name('accounts.create');
Route::post('/account/create', [\App\Http\Controllers\AccountController::class, 'store'])->middleware(['auth', 'verified'])->name('accounts.store');

Route::get('/transfer', [\App\Http\Controllers\MoneyTransferController::class, 'index'])->middleware(['auth', 'verified'])->name('transfer');
Route::post('/transfer', [\App\Http\Controllers\MoneyTransferController::class, 'store'])->middleware(['auth', 'verified'])->name('store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__ . '/auth.php';
