<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Products
Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/{id}', [ProductsController::class, 'show'])->name('products.show');
    Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
    Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
    Route::post('/{id}', [ProductsController::class, 'update'])->name('products.update');
});

// Categories
Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/{id}', [CategoriesController::class, 'show'])->name('categories.show');
    Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
    Route::get('/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('/{id}', [CategoriesController::class, 'update'])->name('categories.update');
});

// Users
Route::group(['prefix' => 'users'], function () {
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/{id}/update-another-user', [UserController::class, 'updateAnotherUser'])->name('users.update-another-user');
});

Auth::routes([
    'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
