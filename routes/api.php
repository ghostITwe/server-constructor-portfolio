<?php

use App\Http\Controllers\api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/registration', [AuthController::class, 'registration']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});