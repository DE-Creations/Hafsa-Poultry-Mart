<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\GRNController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfitLossReportController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SuppliersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('/')->group(function () {
    Route::get('dashboardDetails', [DashboardController::class, 'dashboardDetails'])->name('dashboard.dashboard_details');
    Route::get('paymentsToCollect', [DashboardController::class, 'paymentsToCollect'])->name('dashboard.payments_to_collect');
    Route::get('totalSales', [DashboardController::class, 'totalSales'])->name('dashboard.total_sales');
    Route::get('notificationDetails', [DashboardController::class, 'notificationDetails'])->name('dashboard.notification_details');
});

Route::prefix('customers')->group(function () {
    Route::get('/', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('/list', [CustomersController::class, 'list'])->name('customers.list');
    Route::get('ajax/list', [CustomersController::class, 'loadCustomers'])->name('customers.all.list');
    Route::post('/store', [CustomersController::class, 'store'])->name('customers.store');
    Route::get('/get/{customer_id}', [CustomersController::class, 'get'])->name('customers.get');
    Route::post('/update/{customer_id}', [CustomersController::class, 'update'])->name('customers.update');
    Route::delete('/delete/{customer_id}', [CustomersController::class, 'delete'])->name('customers.delete');
});

Route::prefix('suppliers')->group(function () {
    Route::get('/', [SuppliersController::class, 'index'])->name('suppliers.index');
    Route::get('/list', [SuppliersController::class, 'list'])->name('suppliers.list');
    Route::get('ajax/list', [SuppliersController::class, 'loadSuppliers'])->name('suppliers.all.list');
    Route::post('/store', [SuppliersController::class, 'store'])->name('suppliers.store');
    Route::get('/get/{supplier_id}', [SuppliersController::class, 'get'])->name('suppliers.get');
    Route::post('/update/{supplier_id}', [SuppliersController::class, 'update'])->name('suppliers.update');
    Route::delete('/delete/{supplier_id}', [SuppliersController::class, 'delete'])->name('suppliers.delete');
});

Route::prefix('stock')->group(function () {
    Route::get('/', [StockController::class, 'index'])->name('stock.index');
    Route::get('/ajax/list', [StockController::class, 'loadStocks'])->name('stock.all.list');
    Route::post('/store', [StockController::class, 'store'])->name('stock.store');
    Route::get('/get/{stock_id}', [StockController::class, 'get'])->name('stock.get');
    Route::post('/update/{stock_id}', [StockController::class, 'update'])->name('stock.update');
    Route::delete('/delete/{stock_id}', [StockController::class, 'delete'])->name('stock.delete');
});

Route::prefix('invoice')->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/view/{invoice_id}', [InvoiceController::class, 'view'])->name('invoice.view');
    Route::get('/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::get('ajax/list', [InvoiceController::class, 'loadInvoices'])->name('invoice.all.list');
    Route::post('/store', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/edit/{invoice_id}', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::post('/update/{invoice_id}', [InvoiceController::class, 'update'])->name('invoice.update');
    Route::delete('/delete/{invoice_id}', [InvoiceController::class, 'delete'])->name('invoice.delete');
    Route::get('/customer/balance/{customer_id}', [InvoiceController::class, 'getCustomerBalanceForward'])->name('invoice.customer.balance');
    Route::post('/print/{invoice_id}', [InvoiceController::class, "print"])->name('invoice.print');
});

Route::prefix('grn')->group(function () {
    Route::get('/', [GRNController::class, 'index'])->name('grn.index');
    Route::get('/view/{grn_id}', [GRNController::class, 'view'])->name('grn.view');
    Route::get('/create', [GRNController::class, 'create'])->name('grn.create');
    Route::get('ajax/list', [GRNController::class, 'loadGrns'])->name('grn.all.list');
    Route::post('/store', [GRNController::class, 'store'])->name('grn.store');
    Route::get('/edit/{grn_id}', [GRNController::class, 'edit'])->name('grn.edit');
    Route::post('/update/{grn_id}', [GRNController::class, 'update'])->name('grn.update');
    Route::delete('/delete/{grn_id}', [GRNController::class, 'delete'])->name('grn.delete');
    Route::get('/supplier/balance/{supplier_id}', [GRNController::class, 'getSupplierBalanceForward'])->name('grn.supplier.balance');
    Route::post('/print/{grn_id}', [GRNController::class, "print"])->name('grn.print');
});

Route::prefix('expenses')->group(function () {
    Route::get('/', [ExpensesController::class, 'index'])->name('expenses.index');
    Route::get('/create', [ExpensesController::class, 'create'])->name('expenses.create');
    Route::get('ajax/list', [ExpensesController::class, 'loadExpenses'])->name('expenses.all.list');
    Route::post('/store', [ExpensesController::class, 'store'])->name('expenses.store');
    Route::get('/edit/{expense_id}', [ExpensesController::class, 'edit'])->name('expenses.edit');
    Route::post('/update/{expense_id}', [ExpensesController::class, 'update'])->name('expenses.update');
    Route::delete('/delete/{expense_id}', [ExpensesController::class, 'delete'])->name('expenses.delete');

    Route::prefix('/category')->group(function () {
        Route::get('/', [ExpensesController::class, 'goToExpensesCategory'])->name('expenses.category.index');
        Route::get('/get/{expenses_category_id}', [ExpensesController::class, 'getExpensesCategory'])->name('expenses.category.get');
        //Route::get('/create', [ExpensesController::class, 'create'])->name('reports.profit_loss.create');
        Route::get('ajax/list', [ExpensesController::class, 'loadExpensesCategory'])->name('expenses.category.all.list');
        // Route::get('/list', [ExpensesController::class, 'loadExpensesCategories'])->name('reports.profit_loss.category.list');
        Route::post('/store', [ExpensesController::class, 'expenseCategorystore'])->name('expenses.category.store');

        Route::post('/edit/{expenses_category_id}', [ExpensesController::class, 'editExpenseCategory'])->name('expenses.category.edit');
        Route::delete('/delete/{expenses_category_id}', [ExpensesController::class, 'deleteExpensesCategory'])->name('expenses.category.delete');
        Route::post('/restore/{expenses_category_id}', [ExpensesController::class, 'restoreExpensesCategory'])->name('expenses.category.restore');
    });


    // Route::get('/category/list', [ExpensesController::class, 'loadExpensesCategories'])->name('expenses.category.list');
    //Route::post('/category/store', [ExpensesController::class, 'expenseCategorystore'])->name('expenses.category.store');
});

Route::prefix('reports')->group(function () {
    Route::prefix('invoice')->group(function () {
        Route::get('/', [InvoiceReportController::class, 'index'])->name('reports.invoice.index');
        // Route::get('/', [ReportController::class, 'invoice'])->name('report.invoice.index');
        Route::post('/loadReport', [InvoiceReportController::class, 'loadReport'])->name('report.invoice.loadReport');
        Route::post('/print', [InvoiceReportController::class, 'print'])->name('report.invoice.print');
    });

    Route::prefix('expense')->group(function () {
        Route::get('/', [ExpenseReportController::class, 'index'])->name('reports.expense.index');
        // Route::get('/', [ReportController::class, 'invoice'])->name('report.invoice.index');
        Route::post('/loadReport', [ExpenseReportController::class, 'loadReport'])->name('report.expense.loadReport');
        Route::post('/print', [ExpenseReportController::class, 'print'])->name('report.expense.print');
    });

    Route::prefix('sales')->group(function () {
        Route::get('/', [SalesReportController::class, 'index'])->name('reports.sales.index');
        // Route::get('/', [ReportController::class, 'invoice'])->name('report.invoice.index');
        Route::post('/loadReport', [SalesReportController::class, 'loadReport'])->name('report.sales.loadReport');
        Route::post('/print', [SalesReportController::class, 'print'])->name('report.sales.print');
    });

    Route::prefix('profit_loss')->group(function () {
        Route::get('/', [ProfitLossReportController::class, 'index'])->name('reports.profit_loss.index');
        Route::post('/loadReport', [ProfitLossReportController::class, 'loadReport'])->name('reports.profit_loss.loadReport');
        Route::post('/print', [ProfitLossReportController::class, 'print'])->name('reports.profit_loss.print');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
