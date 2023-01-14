<?php

use Illuminate\Support\Facades\Route;
use Modules\Course\Http\Controllers\OfflineCourseController;
use Modules\Course\Http\Controllers\OnlineCourseController;

Route::group([
    'prefix' => 'course',
], function () {

    Route::group([
        'prefix' => 'offline'
    ],function(){
        Route::get('/', [OfflineCourseController::class, 'listOfflineCourses']);
        Route::get('/{id}', [OfflineCourseController::class, 'showOfflineCourse']);
        Route::post('/{id}/subscribe', [OfflineCourseController::class, 'subscribeOfflineCourse'])->middleware('api.third-party-auth');
        Route::get('/{id}/comment', [OfflineCourseController::class, 'commentOfflineCourse']);
    });

    Route::group([
        'prefix' => 'online'
    ],function(){
        Route::get('/', [OnlineCourseController::class, 'listOnlineCourses'])->middleware('api.third-party-auth');
        Route::get('/{id}', [OnlineCourseController::class, 'showOnlineCourse']);
        Route::post('/{id}/subscribe', [OnlineCourseController::class, 'subscribeOnlineCourse'])->middleware('api.third-party-auth');
        Route::get('/{id}/comment', [OnlineCourseController::class, 'commentOnlineCourse']);
    });



});
