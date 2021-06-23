<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, RoleController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('home', 'home')->name('home');

    Route::get('/profile', [UserController::class, 'profile']);

    Route::delete('user/{user:id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('user/{user:id}', [UserController::class, 'update'])->name('user.update');

    Route::post('role/{role:slug}/user', [UserController::class, 'store'])->name('user.store');
    Route::get('role/{role:slug}/search', [UserController::class, 'search'])->name('user.search');

    Route::resource('role', RoleController::class)->only('show');
});
