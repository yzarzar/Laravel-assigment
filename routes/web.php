<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
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
    Route::delete('/{id}/force', [CategoriesController::class, 'forceDelete'])->name('categories.force-delete');
    Route::get('/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('/{id}', [CategoriesController::class, 'update'])->name('categories.update');
});

// Permissions
Route::group(['prefix' => 'permissions'], function () {
    Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::delete('/{id}/force', [PermissionController::class, 'forceDelete'])->name('permissions.force-delete');
});

// Roles
Route::group(['prefix' => 'roles', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::delete('/{id}/force', [RoleController::class, 'forceDelete'])->name('roles.force-delete');
});

// Users
Route::group(['prefix' => 'users'], function () {
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Auth::routes([
    'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
