<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;

use App\Livewire\Admin\Dashboard\ListDashboard;

Route::get('/timer-component', App\Livewire\TimerComponent::class)->name('timer-component');

Route::get('/role', App\Livewire\Admin\Role\RoleList::class)->name('role');
Route::get('/permission', App\Livewire\Admin\Permission\PermissionList::class)->name('permission');



use App\Http\Controllers\LanguageController;


Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|id|jp'], 'middleware' => 'language'], function () {
    Route::get('/set-language', [LanguageController::class, 'setLanguage'])->name('set-language');
    Route::get('/dashboard', ListDashboard::class)->name('dashboard');
});


    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');


    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


Route::get('/login', App\Livewire\Auth\Login::class)->name('login');
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';




