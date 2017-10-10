<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => ['adminAuth', 'web'],
    'namespace' => 'Dosarkz\LaravelAdmin\Controllers'], function () {

    Route::get('login','AuthController@showLoginForm');

    Route::get('/', 'MainController@index');
    Route::resource('modules','ModuleController');
    Route::resource('users', 'UserResourceController');
});