<?php

use Illuminate\Support\Facades\Route;
use Modules\Need\Http\Controllers\NeedController;

Route::group([
    'prefix' => 'need',
], function () {
    Route::get('/contents', [NeedController::class, 'contents']);
    Route::get('/sliders', [NeedController::class, 'sliders']);
    Route::get('/trainings-categories', [NeedController::class, 'trainingCategories']);
    Route::get('/trainings-titles', [NeedController::class, 'trainingsTitles']);
    Route::get('/', [NeedController::class, 'needs'])->middleware('api.third-party-auth');
    Route::get('/{id}', [NeedController::class, 'show'])->middleware('api.third-party-auth');
    Route::post('/', [NeedController::class, 'store'])->middleware('api.third-party-auth');
    Route::post('/{id}/cancel', [NeedController::class, 'cancel'])->middleware('api.third-party-auth');




});
