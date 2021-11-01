<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;

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

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);

    Route::prefix('login')->group(function () {
        Route::post('/', [AuthController::class, 'login']);

        Route::prefix('{provider}')->middleware('provider.check')->group(function () {
            Route::get('/', [AuthController::class, 'redirectToProvider']);
            Route::get('callback', [AuthController::class, 'handleProviderCallback']);
        });
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('self', [AuthController::class, 'self']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::prefix('users')->group(function () {
        Route::delete('/', [UserController::class, 'delete']);
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::get('{course}', [CourseController::class, 'show']);
        Route::post('/', [CourseController::class, 'store']);
        Route::put('{course}', [CourseController::class, 'update']);
        Route::delete('{course}', [CourseController::class, 'delete']);
    });
});