<?php
namespace Dosarkz\Dosmin\Exceptions;

class ModuleNotFoundException extends \Exception {
    /**
     * ModuleNotFoundException constructor.
     * @param string $slug
     */
    public function __construct($slug)
    {
        parent::__construct('Module with slug name [' . $slug . '] not found');
    }
}