<?php

use App\Http\Controllers\Owner\AuthController;
use App\Http\Controllers\Owner\ProjectController;
use App\Http\Controllers\Owner\ProjectTimeSheetController;
use App\Http\Controllers\Owner\ReportController;
use App\Http\Controllers\Owner\UserController;
use App\Http\Middleware\LogRoute;
use App\Http\Middleware\UserAuthentication;
use App\Http\Middleware\XssSanitization;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'middleware' => [LogRoute::class, XssSanitization::class]], function () {

    Route::group(['prefix' => 'owner'], function () {

        // Throttle Start Owner Routes
        Route::middleware('throttle:60,1')->group(function () {
            // for send otp and login
            Route::group(['prefix' => 'login'], function () {
                Route::controller(AuthController::class)->group(function () {
                    Route::post('/login', 'OwnerLogin');
                });
            });
        });
        // Throttle End Owner Routes

        Route::group(['middleware' => [UserAuthentication::class]], function () {

            Route::group(['prefix' => 'user'], function () {
                Route::controller(UserController::class)->group(function () {
                    Route::post('/list', 'index');
                    Route::post('/store', 'store');
                    Route::post('/update', 'update');
                    Route::post('/view', 'view');
                    Route::post('/change-status', 'changeStatus');
                    Route::post('/destroy', 'destroy');
                    Route::post('/dropdown', 'dropDown');
                });
            });

            Route::group(['prefix' => 'project'], function () {
                Route::controller(ProjectController::class)->group(function () {
                    Route::post('/list', 'index');
                    Route::post('/store', 'store');
                    Route::post('/update', 'update');
                    Route::post('/view', 'view');
                    Route::post('/change-status', 'changeStatus');
                    Route::post('/destroy', 'destroy');
                    Route::post('/dropdown', 'dropDown');
                });
            });

            Route::group(['prefix' => 'project-timesheet'], function () {
                Route::controller(ProjectTimeSheetController::class)->group(function () {
                    Route::post('/list', 'index');
                    Route::post('/store', 'store');
                    Route::post('/update', 'update');
                    Route::post('/view', 'view');
                    Route::post('/change-status', 'changeStatus');
                    Route::post('/destroy', 'destroy');
                });
            });

            Route::group(['prefix' => 'report'], function () {
                Route::controller(ReportController::class)->group(function () {
                    Route::post('/list', 'index');
                });
            });
        });
    });
});
