<?php

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

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::view('profile', 'profile')
        ->name('profile');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('customers', 'customer')->name('customers');
    Route::view('suppliers', 'supplier')->name('suppliers');
    Route::view('users', 'user')->name('users');
    Route::view('jobs', 'job')->name('jobs');
    Route::view('items', 'item')->name('items');
    Route::view('sales', 'sale')->name('sales');
    Route::view('receivings', 'receiving')->name('receivings');
    Route::view('reports', 'report')->name('reports');
    Route::view('settings', 'setting')->name('settings');
});

require __DIR__ . '/auth.php';
