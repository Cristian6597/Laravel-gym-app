<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientProfileController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\TrainerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Auth Routes with Sanctum
|--------------------------------------------------------------------------
*/


Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', 'user');
        Route::post('/logout', 'logout');
        Route::post('/logout-all', 'logoutAll');
        Route::get('/tokens', 'tokens');
    });
});

Route::apiResource('clients', ClientProfileController::class)->middleware('auth:sanctum');
Route::apiResource('exercises', ExerciseController::class)->middleware('auth:sanctum');
Route::apiResource('trainers', TrainerController::class)->middleware('auth:sanctum');
