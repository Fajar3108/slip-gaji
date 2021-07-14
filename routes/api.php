<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{AuthController, SalaryController};
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('users/update-password', [AuthController::class, 'updatePassword']);
    Route::post('users/update', [AuthController::class, 'update']);

    Route::get('salary', [SalaryController::class, 'show']);
    Route::get('salary/{salary:id}/pdf', [SalaryController::class, 'print_pdf']);
});

Route::delete('salary', [SalaryController::class, 'massDestroy'])->middleware('auth');
Route::delete('user', [UserController::class, 'massDestroy'])->middleware('auth');
