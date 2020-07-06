<?php

Route::group([
    'prefix' => 'lora',
    'as' => 'lora.',
    'middleware' => [ 'web', 'language'],
    'namespace' => config('lora.routes.namespace')], function () {

    Route::get('login', config('lora.routes.auth.getLogin'))->name('auth.show');
    Route::post('login', config('lora.routes.auth.postLogin'))->name('auth.login');

    Route::group(['middleware' => 'guardAuth:admin'], function() {
        Route::get('/', config('lora.routes.main.index'))->name('dashboard.index');
        Route::get('settings', config('lora.routes.main.getSettings'))->name('accounts.settings.index');
        Route::post('settings', config('lora.routes.main.postSettings'))->name('accounts.settings');
        Route::delete('settings/remove-image', config('lora.routes.main.destroyAvatar'))->name('accounts.image.destroy');
        Route::get('/reset-password',  config('lora.routes.main.getResetPassword'))->name('accounts.password.index');
        Route::post('/reset-password', config('lora.routes.main.postResetPassword'))->name('accounts.password.update');

        Route::post('logout', config('lora.routes.auth.logout'))->name('logout');

        Route::resource('accounts', config('lora.routes.resources.accounts'));
        Route::resource('menus', config('lora.routes.resources.menus'));
        Route::resource('menus.items', config('lora.routes.resources.menuItems'));
        Route::resource('roles', config('lora.routes.resources.roles'));
    });
});
