<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, RoleController, SalaryController};

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
    return redirect()->route('home');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::view('home', 'home')->name('home');

    Route::get('/profile', [UserController::class, 'profile']);

    Route::delete('user/{user:id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/user/import', [UserController::class, 'import'])->name('user.import');
    Route::post('user/{user:id}', [UserController::class, 'update'])->name('user.update');
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('user/search', [UserController::class, 'search'])->name('user.search');
    Route::get('user/{user:id}', [UserController::class, 'show'])->name('user.show');


    Route::resource('role', RoleController::class)->only('show');

    Route::resource('salary', SalaryController::class);
    Route::get('salary/search', [SalaryController::class, 'search'])->name('salary.search');
    Route::post('salary/import', [SalaryController::class, 'import'])->name('salary.import');
    Route::get('salary/{salary:id}/pdf', [SalaryController::class, 'print_pdf'])->name('salary.pdf');
});
