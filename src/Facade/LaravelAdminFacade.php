<?php
namespace Dosarkz\LaravelAdmin\Facade;

use Illuminate\Support\Facades\Facade;

class LaravelAdminFacade extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-admin';
    }
}