<?php

Route::group([
    'prefix' => 'lora',
    'middleware' => [ 'web', 'language'],
    'namespace' => 'Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers'], function () {

    Route::get('login','Auth\LoginController@showLoginForm')->name('admin.getLogin');
    Route::post('login','Auth\LoginController@postLogin')->name('admin.postLogin');

    Route::group(['middleware' => 'guardAuth:admin'], function() {
        Route::get('/', 'AppController@index');
        Route::get('settings','AppController@settings');
        Route::post('settings', 'AppController@postSettings');
        Route::delete('settings/remove-image', 'AppController@removeImage');
        Route::get('/reset-password', 'AppController@getResetPassword');
        Route::post('/reset-password', 'AppController@postResetPassword');

        Route::post('logout','Auth\LoginController@getLogout')->name('admin.logout');

//        Route::group(['prefix' => 'modules'], function(){
//            Route::get('{module_alias}/settings', 'ModulesController@settings');
//        });

//        Route::resource('modules', 'ModulesController');
        Route::resource('menu','Resources\MenuController');
        Route::resource('menu.items', 'Resources\MenuItemController');
        Route::resource('role', 'Resources\RoleController');
    });
});
