<?php

use App\Http\Controllers\JobOrderInvoice;
use App\Http\Controllers\PrintItem;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintReport;
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
use App\Livewire\Setup\Index as Setup;
use App\Livewire\Customer\Index as Customer;
use App\Livewire\Customer\DetailCustomer as CustomerDetail;
use App\Livewire\Supplier\Index as Supplier;
use App\Livewire\Supplier\DetailSupplier as SupplierDetail;
use App\Livewire\Employee\Index as Employee;
use App\Livewire\Employee\DetailEmployee as EmployeeDetail;
use App\Livewire\User\Index as User;
use App\Livewire\Role\Index as Role;
use App\Livewire\User\Profile as Profile;
use App\Livewire\Item\Index as Item;
use App\Livewire\Sale\Index as Sale;
use App\Livewire\Job\Index as Job;
use App\Livewire\Setting\Index as Setting;
use App\Livewire\Receiving\Index as Receiving;
use App\Livewire\Report\Index as Report;
use App\Livewire\Inventory\Index as Inventory;
use App\Livewire\Expense\Index as Expenses;
use App\Livewire\GlobalSearch\Result as GlobalSeachResult;

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome');
    Route::get('/setup', Setup::class)->name('setup');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/customers', Customer::class)->name('customers');
    Route::get('/customer/{customerId}', CustomerDetail::class)->name('customer-detail');
    Route::get('/suppliers', Supplier::class)->name('suppliers');
    Route::get('/supplier/{supplierId}', SupplierDetail::class)->name('supplier-detail');
    Route::get('/employees', Employee::class)->name('employees');
    Route::get('/employee/{employeeId}', EmployeeDetail::class)->name('employee-detail');
    Route::get('/items', Item::class)->name('items');
    Route::get('/users', User::class)->name('users');
    Route::get('/roles', Role::class)->name('roles');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/jobs/{option}', Job::class)->name('jobs');
    Route::get('/job/invoice/{jobId}', JobOrderInvoice::class)->name('job-invoice');
    Route::get('/sales/{option}', Sale::class)->name('sales');
    Route::get('/receivings/{option}', Receiving::class)->name('receivings');
    Route::get('/inventories', Inventory::class)->name('inventories');
    Route::get('/reports', Report::class)->name('reports');
    Route::get('/expenses', Expenses::class)->name('expenses');
    Route::get('/settings', Setting::class)->name('settings');

    Route::get('/global-search/car/{carId}', GlobalSeachResult::class)->name('search-result');

    Route::get('/report/print/{from}/{to}', PrintReport::class)->name('print-report');
    Route::get('/report/print-items', PrintItem::class)->name('print-item');
});

require __DIR__ . '/auth.php';
