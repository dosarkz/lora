<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'web'],
    'namespace' => 'Dosarkz\LaravelAdmin\Controllers'], function () {

    Route::get('login','AuthController@showLoginForm')->name('admin.getLogin');
    Route::post('login','AuthController@postLogin')->name('admin.postLogin');

    Route::group(['middleware' => 'guardAuth:admin'], function() {
        Route::get('/', 'MainController@index');

        Route::group(['prefix' => 'modules'], function(){
            Route::get('{module_alias}/settings', 'ModulesController@settings');
        });

        Route::resource('modules', 'ModulesController');
        Route::post('logout','AuthController@getLogout')->name('admin.logout');
    });
});