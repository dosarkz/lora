<?php
namespace Dosarkz\LaravelAdmin\Generators;
/**
 * Class Folder
 * @package Dosarkz\LaravelAdmin\Generators
 */
class Folder
{
    public $dir;
    public $path;
    public $subs;

    public function __construct($dir, $path = '', $subs = [])
    {
        $this->dir = $dir;
        $this->path = $path;
        $this->subs = $subs;
    }

}