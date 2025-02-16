<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TranslationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::post('/login', [AuthController::class,'login'])->name('login.api');
Route::post('/register', [AuthController::class,'register'])->name('register.api');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'auth:api'
], function () {
    Route::get('translations/export', [TranslationController::class, 'export']);
    Route::apiResource('translations', TranslationController::class);
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
    // Passport routes...
});
