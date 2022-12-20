<?php

use Illuminate\Support\Facades\Route;
use Modules\Need\Http\Controllers\NeedController;

Route::group([
    'prefix' => 'need',
//    'middleware'=>'api.third-party-auth'
], function () {
    Route::get('/contents', [NeedController::class, 'contents']);
    Route::get('/sliders', [NeedController::class, 'sliders']);
    Route::get('/trainings-categories', [NeedController::class, 'trainingCategories']);
    Route::get('/trainings-titles', [NeedController::class, 'trainingsTitles']);
    Route::get('/', [NeedController::class, 'needs']);
    Route::get('/{id}', [NeedController::class, 'show']);
    Route::post('/', [NeedController::class, 'store']);
    Route::post('/{id}/cancel', [NeedController::class, 'cancel']);




});
