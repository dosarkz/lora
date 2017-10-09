<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth'],
    'namespace' => 'Dosarkz\LaravelAdmin\Controllers'], function () {

    Route::get('/', 'MainController@index');
    Route::resource('modules','ModuleController');
    Route::resource('users', 'UserResourceController');
});