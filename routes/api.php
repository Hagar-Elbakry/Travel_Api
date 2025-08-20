<?php

use App\Http\Controllers\Api\V1\TourController;
use App\Http\Controllers\Api\V1\TravelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('travels', [TravelController::class, 'index']);
    Route::get('travels/{travel:slug}/tours', [TourController::class, 'index']);
});
