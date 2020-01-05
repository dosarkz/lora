<?php
namespace Dosarkz\Lora\Facade;

use Illuminate\Support\Facades\Facade;
/**
 * @method static  renderView(string $route)
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
