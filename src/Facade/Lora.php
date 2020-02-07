<?php
namespace Dosarkz\Lora\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getLayoutPath()
 * @method static string getAuthLayoutPath()
 * @method static renderView(string $route, array $data = [], array $mergeData = [], string $group = 'lora')
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
