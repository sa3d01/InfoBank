<?php

use Illuminate\Support\Facades\Route;
use Modules\Enrichment\Http\Controllers\EnrichmentController;

Route::group([
    'prefix' => 'enrichment',
], function () {
    Route::get('/slider', [EnrichmentController::class, 'slider']);
    Route::get('/index', [EnrichmentController::class, 'index']);
    Route::get('/faqs', [EnrichmentController::class, 'faqs']);
    Route::get('/{id}', [EnrichmentController::class, 'show']);
});
