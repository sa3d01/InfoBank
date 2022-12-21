<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function() {
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.submit');
        Route::post('/logout', 'LoginController@logout')->name('logout');
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
    });
    Route::get('/profile', 'AdminController@profile')->name('profile');
    Route::put('/profile', 'AdminController@updateProfile')->name('profile.update');
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('brand_owner/{id}/ban', 'BrandOwnerController@ban')->name('brand_owner.ban');
    Route::get('brand_owner/{id}/activate', 'BrandOwnerController@activate')->name('brand_owner.activate');
    Route::resource('brand_owner', 'BrandOwnerController');

    Route::get('brand/{id}/ban', 'BrandController@ban')->name('brand.ban');
    Route::get('brand/{id}/activate', 'BrandController@activate')->name('brand.activate');
    Route::resource('brand', 'BrandController');

    Route::get('location/{id}/ban', 'LocationController@ban')->name('location.ban');
    Route::get('location/{id}/activate', 'LocationController@activate')->name('location.activate');
    Route::resource('location', 'LocationController');

    Route::get('slider/{id}/ban', 'SliderController@ban')->name('slider.ban');
    Route::get('slider/{id}/activate', 'SliderController@activate')->name('slider.activate');
    Route::resource('slider', 'SliderController');

    Route::resource('employee', 'EmployeeController');

    Route::get('promo_code/{id}/ban', 'PromoCodeController@ban')->name('promo_code.ban');
    Route::get('promo_code/{id}/activate', 'PromoCodeController@activate')->name('promo_code.activate');
    Route::resource('promo_code', 'PromoCodeController');

    Route::resource('order', 'OrderController');
    Route::get('order/{id}/chat', 'OrderController@chat')->name('order.chat');
    Route::get('order/{id}/invoice', 'OrderController@invoice')->name('order.invoice');

});
