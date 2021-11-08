<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;

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

Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
    Route::get('self', [AuthController::class, 'self']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::delete('/', [UserController::class, 'delete']);
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::post('/', [CourseController::class, 'store']);
        Route::get('search/{title}', [CourseController::class, 'search']);

        Route::get('{course:slug}', [CourseController::class, 'show']);
        Route::prefix('{course}')->group(function () {
            Route::put('/', [CourseController::class, 'update']);
            Route::put('like', [CourseController::class, 'like']);
            Route::put('dislike', [CourseController::class, 'dislike']);
            Route::delete('/', [CourseController::class, 'delete']);
        });
    });

    Route::prefix('categories')->group(function () {
        Route::prefix('{category}')->group(function () {
            Route::put('/', [CategoryController::class, 'update']);
            Route::delete('/', [CategoryController::class, 'delete']);
        });
    });
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('{category:slug}', [CategoryController::class, 'show']);
});