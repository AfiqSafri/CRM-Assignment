<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;


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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('customers', CustomerController::class)->middleware('auth');

// Route::get('customers/export/excel', [CustomerController::class, 'exportExcel'])->name('customers.export.excel');

// Route::get('customers/export/pdf', [CustomerController::class, 'exportPDF'])->name('customers.export.pdf');

Route::get('customers/export/excel', [CustomerController::class, 'exportExcel'])->name('customers.export.excel');

Route::get('customers/export/pdf', [CustomerController::class, 'exportPDF'])->name('customers.export.pdf');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

Route::get('reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');

Route::get('reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');

Route::get('reports', [ReportController::class, 'index'])->name('reports.index');


// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


require __DIR__.'/auth.php';
