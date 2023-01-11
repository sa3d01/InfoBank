<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'course',
], function () {
    Route::get('/', [NeedController::class, 'needs'])->middleware('api.third-party-auth');



});
