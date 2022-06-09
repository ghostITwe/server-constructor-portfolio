<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PortfolioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/registration', [AuthController::class, 'registration']);

Route::get('/portfolio/{username}', [PortfolioController::class, 'getPortfolio']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/portfolio', [PortfolioController::class, 'savePortfolio']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

