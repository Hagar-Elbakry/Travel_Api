<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\TourController;
use App\Http\Controllers\Api\V1\TravelController;
use App\Http\Controllers\Api\V1\Admin;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('travels', [TravelController::class, 'index']);
    Route::get('travels/{travel:slug}/tours', [TourController::class, 'index']);
    Route::post('login', LoginController::class);
});

Route::prefix('v1/admin')->middleware('auth:sanctum')->group(function () {

    Route::middleware('role:admin')->group(function () {
        Route::post('travels', [Admin\TravelController::class, 'store']);
        Route::post('travels/{travel:slug}/tours', [Admin\TourController::class, 'store']);
    });

    Route::patch('travels/{travel:slug}', [Admin\TravelController::class, 'update']);
});
