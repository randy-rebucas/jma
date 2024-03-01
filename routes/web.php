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
use App\Livewire\Dashboard;
use App\Livewire\Customer\Index as Customer;
use App\Livewire\Customer\DetailCustomer as CustomerDetail;
use App\Livewire\Supplier\Index as Supplier;
use App\Livewire\Supplier\DetailSupplier as SupplierDetail;
use App\Livewire\User\Index as User;
use App\Livewire\User\Profile as Profile;
use App\Livewire\Item\Index as Item;
use App\Livewire\Sale\Index as Sale;
use App\Livewire\Job\Index as Job;
use App\Livewire\Setting\Index as Setting;
use App\Livewire\Receiving\Index as Receiving;
use App\Livewire\Report\Index as Report;
use App\Livewire\Inventory\Index as Inventory;

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/customers', Customer::class)->name('customers');
    Route::get('/customer/{customerId}', CustomerDetail::class)->name('customer-detail');
    Route::get('/suppliers', Supplier::class)->name('suppliers');
    Route::get('/supplier/{supplierId}', SupplierDetail::class)->name('supplier-detail');
    Route::get('/items', Item::class)->name('items');
    Route::get('/users', User::class)->name('users');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/jobs/{option}', Job::class)->name('jobs');
    Route::get('/sales/{option}', Sale::class)->name('sales');
    Route::get('/receivings/{option}', Receiving::class)->name('receivings');
    Route::get('/inventories', Inventory::class)->name('inventories');
    Route::get('/reports', Report::class)->name('reports');
    Route::get('/settings', Setting::class)->name('settings');
});

require __DIR__ . '/auth.php';
