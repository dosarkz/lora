<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'web', 'language'],
    'namespace' => 'Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers'], function () {

    Route::get('login','AuthController@showLoginForm')->name('admin.getLogin');
    Route::post('login','AuthController@postLogin')->name('admin.postLogin');

    Route::group(['middleware' => 'guardAuth:admin'], function() {
        Route::get('/', 'MainController@index');

        Route::get('settings','MainController@settings');
        Route::post('settings', 'MainController@postSettings');

        Route::delete('settings/remove-image', 'MainController@removeImage');

        Route::get('/reset-password', 'MainController@getResetPassword');
        Route::post('/reset-password', 'MainController@postResetPassword');

        Route::group(['prefix' => 'modules'], function(){
            Route::get('{module_alias}/settings', 'ModulesController@settings');
        });

        Route::resource('modules', 'ModulesController');
        Route::post('logout','AuthController@getLogout')->name('admin.logout');

        Route::resource('menu','MenuController');
        Route::resource('menu.items', 'MenuItemController');
        Route::resource('role', 'LoraRoleController');
    });
});
