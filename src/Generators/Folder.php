<?php
namespace Dosarkz\Dosmin\Generators;
/**
 * Class Folder
 * @package Dosarkz\Dosmin\Generators
 */
class Folder
{
    /**
     * @var
     */
    public $dir;
    /**
     * @var
     */
    public $path;
    /**
     * @var
     */
    public $subs;
    /**
     * @var
     */
    public $files;

    /**
     * Folder constructor.
     * @param $dir
     * @param string $path
     * @param array $subs
     * @param array $files
     */
    public function __construct($dir, $path = '', $subs = [], $files = [])
    {
        $this->dir = $dir;
        $this->path = $path;
        $this->subs = $subs;
        $this->files = $files;
    }

}