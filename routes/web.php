<?php

use App\Http\Controllers\Owner\FacebookController;
use App\Http\Controllers\Owner\FacebookWebhookController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('db:seed --class=DatabaseSeeder');

        return 'Cache cleared successfully';
    });

    Route::get('/migrate', function () {
        Artisan::call('migrate');
        return 'Database migrated successfully';
    });

    Route::get('/mongo-test', [TestController::class, 'mongoTest']);
    Route::get('/terms', function () {
        return view('Owner.terms');
    });

    Route::get('/privacy', function () {
        return view('Owner.privacy');
    });

    Route::get('/auth/facebook', [FacebookController::class, 'redirect']);
    Route::get('/facebook-login-redirect-url', [FacebookController::class, 'callback']);
    Route::post('/facebook/forms', [FacebookController::class, 'forms'])->name('facebook.forms');
    Route::post('/facebook/leads', [FacebookController::class, 'leads'])->name('facebook.leads');

    Route::get('/leadTest', [FacebookWebhookController::class, 'leadTest']);
});
