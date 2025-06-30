<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/menus', [App\Http\Controllers\MenuController::class, 'index'])->name('public.menus.index');
Route::get('/home', [App\Http\Controllers\MenuController::class, 'indexPublic'])->name('public.home');

// --------------------
// AUTH ROUTES CUSTOM
// --------------------
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');

Route::get('/register', [UserController::class, 'registerForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->name('cart.')->prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');             
    Route::post('/add/{menu}', [CartController::class, 'add'])->name('add');       
    Route::post('/update/{menu}', [CartController::class, 'update'])->name('update'); 
    Route::post('/remove/{menu}', [CartController::class, 'remove'])->name('remove'); 
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');       
});

// --------------------
// ADMIN-PROTECTED ROUTES
// --------------------
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard utama
    Route::get('/', [ReportController::class, 'index'])->name('index');

    // Resource routes
    Route::resource('customers', CustomerController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('menus', MenuController::class);
     Route::resource('orders', OrderController::class)
        ->names([
            'index'   => 'order.index',    
            'create'  => 'order.create',   
            'store'   => 'order.store',    
            'show'    => 'order.show',     
            'edit'    => 'order.edit',     
            'update'  => 'order.update',   
            'destroy' => 'order.destroy',  
        ]);

    // Ajax form edit (modal)
    Route::post('/ajax/category/getEditForm', [CategoryController::class, 'getEditForm'])->name('categories.getEditForm');
    Route::post('/ajax/menu/getEditForm', [MenuController::class, 'getEditForm'])->name('menus.getEditForm');

    // Transactions
    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/create', [TransactionController::class, 'create'])->name('create');
        Route::post('/', [TransactionController::class, 'store'])->name('store');
        Route::get('/{id}', [TransactionController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [TransactionController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TransactionController::class, 'update'])->name('update');
        Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('destroy');
    });

    // Image Menu
    Route::get('/menus/{id}/image', [MenuController::class, 'getImage']);

});

