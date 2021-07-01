<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{AuthController, SalaryController};

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
    Route::get('salary', [SalaryController::class, 'show']);
    Route::get('salary/{salary:id}/pdf', [SalaryController::class, 'print_pdf']);
});
