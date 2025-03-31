<?php

use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

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

// Route::get('/', Welcome::class);
Route::get('/', \App\Livewire\Auth\Login::class)->name('login');
Route::get('/register', \App\Livewire\Auth\Register::class)->name('register');



// Rute untuk pengaturan bahasa
Route::get('/lang/{lang}', [LanguageController::class, 'setLanguage'])->name('changeLanguage');

Route::group(['prefix' => '{lang}'], function ()
{
    # admin
    Route::get('/dashboard', \App\Livewire\Admin\Dashboard\ListDashboard::class)->name('dasboard');

});




Route::get('/cek', function () {
    return view('cek');
})->name('cek');

