<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
    Route::get('/{id}', [ProductsController::class, 'show'])->name('products.show');
    Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
});
