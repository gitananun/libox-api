<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\NotificationController;

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

    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

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
        Route::put('/', [UserController::class, 'update']);
        Route::prefix('notifications')->group(function () {
            Route::get('/', [NotificationController::class, 'index']);
            Route::put('/', [NotificationController::class, 'readAll']);
            Route::get('{notification}', [NotificationController::class, 'read']);
        });
        Route::delete('/', [UserController::class, 'delete']);
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::post('/', [CourseController::class, 'store']);

        Route::prefix('favorites')->group(function () {
            Route::get('/', [CourseController::class, 'indexFavorites']);
            Route::put('/', [CourseController::class, 'addFavorites']);
            Route::delete('/', [CourseController::class, 'removeFavorites']);
        });

        Route::get('{course:slug}', [CourseController::class, 'show']);
        Route::prefix('{course}')->group(function () {
            Route::put('/', [CourseController::class, 'update']);
            Route::put('like', [CourseController::class, 'like']);
            Route::put('dislike', [CourseController::class, 'dislike']);
            Route::delete('/', [CourseController::class, 'delete']);
        });

    });

    Route::prefix('categories')->middleware('can:is_admin')->group(function () {
        Route::post('/', [CategoryController::class, 'store']);
        Route::prefix('{category}')->group(function () {
            Route::put('/', [CategoryController::class, 'update']);
            Route::delete('/', [CategoryController::class, 'delete']);
        });
    });

    Route::prefix('posts')->middleware('can:is_admin')->group(function () {
        Route::post('/', [PostController::class, 'store']);
        Route::put('{post}', [PostController::class, 'update']);
        Route::delete('{post}', [PostController::class, 'delete']);
    });

    Route::prefix('statistics')->middleware('can:is_admin')->group(function () {
        Route::get('/', [StatisticController::class, 'index']);
    });
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('{category:slug}', [CategoryController::class, 'show']);
});

Route::prefix('badges')->group(function () {
    Route::get('/', [BadgeController::class, 'index']);
});

Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index']);
    Route::post('search/{title}', [CourseController::class, 'search']);
    Route::get('{course:slug}', [CourseController::class, 'show']);
});

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('search/{title}', [PostController::class, 'search']);
    Route::get('{post:slug}', [PostController::class, 'show']);
});

Route::prefix('instructors')->group(function () {
    Route::get('/', [InstructorController::class, 'index']);
    Route::get('search/{name}', [InstructorController::class, 'search']);
});

Route::any('ping', [Controller::class, 'ping']);