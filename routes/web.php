<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\GRNController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuppliersController;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('customers')->group(function () {
    Route::get('/', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('/list', [CustomersController::class, 'list'])->name('customers.list');
    Route::post('/store', [CustomersController::class, 'store'])->name('customers.store');
    Route::get('/get/{customer_id}', [CustomersController::class, 'get'])->name('customers.get');
    Route::post('/update/{customer_id}', [CustomersController::class, 'update'])->name('customers.update');
    Route::delete('/delete/{customer_id}', [CustomersController::class, 'delete'])->name('customers.delete');
});

Route::prefix('suppliers')->group(function () {
    Route::get('/', [SuppliersController::class, 'index'])->name('suppliers.index');
    Route::get('/list', [SuppliersController::class, 'list'])->name('suppliers.list');
    Route::post('/store', [SuppliersController::class, 'store'])->name('suppliers.store');
    Route::get('/get/{supplier_id}', [SuppliersController::class, 'get'])->name('suppliers.get');
    Route::post('/update/{supplier_id}', [SuppliersController::class, 'update'])->name('suppliers.update');
    Route::delete('/delete/{supplier_id}', [SuppliersController::class, 'delete'])->name('suppliers.delete');
});

Route::prefix('invoice')->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/create', [InvoiceController::class, 'create'])->name('invoice.create');
});

Route::prefix('grn')->group(function () {
    Route::get('/', [GRNController::class, 'index'])->name('grn.index');
    Route::get('/create', [InvoiceController::class, 'create'])->name('grn.create');
});

Route::prefix('expenses')->group(function () {
    Route::get('/', [ExpensesController::class, 'index'])->name('expenses.index');
    Route::get('/create', [ExpensesController::class, 'create'])->name('expenses.create');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
