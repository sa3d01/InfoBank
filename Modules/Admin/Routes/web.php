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

    Route::get('course/{id}/ban', 'CourseController@ban')->name('course.ban');
    Route::get('course/{id}/activate', 'CourseController@activate')->name('course.activate');
    Route::resource('course', 'CourseController');

    Route::get('course/{id}/chapters', 'ChapterController@showCourseChapters')->name('course.chapters');
    Route::get('course/{id}/add-chapter', 'ChapterController@addCourseChapter')->name('chapter.insert');
    Route::post('chapter/store', 'ChapterController@store')->name('chapter.store');
    Route::get('chapter/{id}/edit', 'ChapterController@editCourseChapter')->name('chapter.edit');
    Route::put('chapter/{id}/update', 'ChapterController@update')->name('chapter.update');
    Route::delete('chapter/{id}', 'ChapterController@destroy')->name('chapter.destroy');

    Route::get('course/{id}/sessions', 'SessionController@showCourseSessions')->name('course.sessions');
    Route::get('course/{id}/add-session', 'SessionController@addCourseSession')->name('session.insert');
    Route::post('session/store', 'SessionController@store')->name('session.store');
    Route::get('session/{id}/edit', 'SessionController@editCourseSession')->name('session.edit');
    Route::put('session/{id}/update', 'SessionController@update')->name('session.update');
    Route::delete('session/{id}', 'SessionController@destroy')->name('session.destroy');


    Route::get('course/{id}/attachments', 'AttachmentController@showCourseAttachments')->name('course.attachments');
    Route::get('course/{id}/add-attachment', 'AttachmentController@addCourseAttachment')->name('attachment.insert');
    Route::post('attachment/store', 'AttachmentController@store')->name('attachment.store');
    Route::get('attachment/{id}/edit', 'AttachmentController@editCourseAttachment')->name('attachment.edit');
    Route::put('attachment/{id}/update', 'AttachmentController@update')->name('attachment.update');
    Route::delete('attachment/{id}', 'AttachmentController@destroy')->name('attachment.destroy');

    Route::get('course/{id}/active-students', 'SubscribeController@showCourseActiveStudents')->name('course.active-students');
    Route::get('course/{id}/banned-students', 'SubscribeController@showCourseBannedStudents')->name('course.banned-students');
    Route::post('course_user/{id}/archive', 'SubscribeController@archiveCourseStudent')->name('course_user.archive');
    Route::post('course_user/{id}/undo-archive', 'SubscribeController@undoArchiveStudent')->name('course_user.undo-archive');
    Route::post('course/{id}/upload-users-excel', 'SubscribeController@uploadUsersExcel')->name('course.upload-users-excel');
    Route::post('course/{id}/upload-users-mobile', 'SubscribeController@uploadUsersMobile')->name('course.upload-users-mobile');

});
