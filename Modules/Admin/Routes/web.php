<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function() {
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.submit');
        Route::post('/logout', 'LoginController@logout')->name('logout');
//        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
//        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
//        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
    });
    Route::get('/profile', 'AdminController@profile')->name('profile');
    Route::put('/profile', 'AdminController@updateProfile')->name('profile.update');
    Route::get('/', 'HomeController@index')->name('home');
//categories
    Route::get('enrichment/{id}/ban', 'EnrichmentController@ban')->name('enrichment.ban');
    Route::get('enrichment/{id}/activate', 'EnrichmentController@activate')->name('enrichment.activate');
    Route::resource('enrichment', 'EnrichmentController');


});
