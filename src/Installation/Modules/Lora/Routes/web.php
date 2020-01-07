<?php

Route::group([
    'prefix' => 'lora',
    'name' => 'lora.',
    'middleware' => [ 'web', 'language'],
    'namespace' => 'Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers'], function () {

    Route::get('login','Auth\LoginController@showLoginForm')->name('auth.show');
    Route::post('login','Auth\LoginController@postLogin')->name('auth.login');

    Route::group(['middleware' => 'guardAuth:admin'], function() {
        Route::get('/', 'AppController@index')->name('dashboard.index');
        Route::get('settings','AppController@settings')->name('account.settings.show');
        Route::post('settings', 'AppController@postSettings')->name('account.settings.update');
        Route::delete('settings/remove-image', 'AppController@removeImage')->name('account.image.destroy');
        Route::get('/reset-password', 'AppController@getResetPassword')->name('account.password.index');
        Route::post('/reset-password', 'AppController@postResetPassword')->name('account.password.update');


        Route::post('logout','Auth\LoginController@getLogout')->name('logout');

        Route::resource('accounts', 'Resources\AccountsController');
        Route::resource('menus','Resources\MenuController');
        Route::resource('menus.items', 'Resources\MenuItemController');
        Route::resource('roles', 'Resources\RoleController');
    });
});
