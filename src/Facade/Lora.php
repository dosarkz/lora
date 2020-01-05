<?php
namespace Dosarkz\Lora\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getLayoutPath()
 * @method static string getAuthLayoutPath()
 *
 * @see \Dosarkz\Lora\LoraRepository
 */
class Lora extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lora';
    }
}
