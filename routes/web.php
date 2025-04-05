<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\GRNController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('customers')->group(function () {
    Route::get('/', [CustomersController::class, 'index'])->name('customers.index');
    Route::post('/store', [CustomersController::class, 'store'])->name('customers.store');
    Route::get('/edit', [CustomersController::class, 'edit'])->name('customers.edit');
});

Route::prefix('invoice')->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
});

Route::prefix('grn')->group(function () {
    Route::get('/', [GRNController::class, 'index'])->name('grn.index');
});

Route::prefix('expenses')->group(function () {
    Route::get('/', [ExpensesController::class, 'index'])->name('expenses.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
