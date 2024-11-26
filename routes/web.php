<?php

use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('/admin')
    ->as('admin')
    ->middleware(['auth', 'can:is-admin'])
    ->group(function () {
        Route::get('categories/create', function () {
            return Inertia::render('Admin/Categories/CreateCategory');
        });

        Route::get('products/create', function(){
            return Inertia::render('Admin/Products/CreateProduct');
        });

        Route::get('customers/create', function(){
            return Inertia::render('Admin/Customers/AddCustomer');
        });
    });


Route::resource('product', ProductController::class);
Route::resource('customer', CustomerController::class);
Route::resource('productCategory', ProductCategoryController::class);
