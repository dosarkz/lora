<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'web'],
    'namespace' => 'Dosarkz\LaravelAdmin\Controllers'], function () {

    Route::get('login','AuthController@showLoginForm')->name('admin.getLogin');
    Route::post('login','AuthController@postLogin')->name('admin.postLogin');

    Route::group(['middleware' => 'adminAuth:admin'], function() {
        Route::get('/', 'MainController@index');
        Route::resource('modules','ModuleController');
        Route::resource('users', 'UserResourceController');

        Route::post('logout','AuthController@getLogout')->name('admin.logout');
    });


});