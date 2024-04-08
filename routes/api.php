<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;

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

Route::controller(UserController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'logout');
    });
});

Route::controller(NewsController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('news', 'index');
        Route::get('news/{news}', 'show');

        Route::middleware(AdminMiddleware::class)->group(function () {
            Route::post('news', 'store');
            Route::patch('news/{news}', 'update');
            Route::delete('news/{news}', 'destroy');
        });
    });
