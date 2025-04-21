<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DetailTransactionController;

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
    return view('welcome');
});

Route::resource('customers',CustomerController::class);
Route::resource('categories',CategoryController::class);
Route::resource('menus', MenuController::class);

Route::prefix('transactions')->name('admin.transactions.')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('index');
    Route::get('/create', [TransactionController::class, 'create'])->name('create');
    Route::post('/', [TransactionController::class, 'store'])->name('store');
    Route::get('/{id}', [TransactionController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [TransactionController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TransactionController::class, 'update'])->name('update');
    Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('destroy');
});


Route::prefix('detail-transactions')->name('admin.detail-transactions.')->group(function () {
    Route::get('/', [DetailTransactionController::class, 'index'])->name('index');
    Route::get('/create', [DetailTransactionController::class, 'create'])->name('create');
    Route::post('/', [DetailTransactionController::class, 'store'])->name('store');
    Route::get('/{id}', [DetailTransactionController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [DetailTransactionController::class, 'edit'])->name('edit');
    Route::put('/{id}', [DetailTransactionController::class, 'update'])->name('update');
    Route::delete('/{id}', [DetailTransactionController::class, 'destroy'])->name('destroy');
});
