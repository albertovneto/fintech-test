<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AccountController,
    TransactionController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AccountController::class)->group(function () {
    Route::get('/account/{id}', 'getById');
    Route::post('/account', 'create');
});

Route::controller(TransactionController::class)->group(function () {
    Route::post('/transaction', 'transaction');
});
