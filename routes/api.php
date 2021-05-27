<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\RegistrationController;

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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['middleware' => 'transaction'], function () {
        Route::post('transactions/{payee}', [\App\Http\Controllers\TransactionController::class, 'makeTransaction'])->name('transactions.make');
    });
});

Route::post('authenticate', [AuthenticationController::class, 'authenticate'])->name('users.login');
Route::post('register', [RegistrationController::class, 'register'])->name('users.register');
