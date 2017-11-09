<?php
namespace Dosarkz\LaravelAdmin;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;

class Module
{
    use Macroable;

    /**
     * @var
     */
    protected $app;

    /**
     * The module name.
     *
     * @var
     */
    protected $name;

    /**
     * The module path.
     *
     * @var string
     */
    protected $path;
    /**
     * @var
     */
    protected $menu;
    /**
     * @var
     */
    protected $enabled;
    /**
     * @var
     */
    protected $installed;
    /**
     * @var
     */
    protected $log_path;



    /**
     * The constructor.
     *
     * @param Container $app
     * @param $name
     * @param $path
     */
    public function __construct(Container $app, $name, $path)
    {
        $this->app =  $app;
        $this->name = $name;

        $this->path = realpath($path);
    }

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param mixed $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function getLocaleName()
    {
       return trans("{$this->name}::module.name");
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getMenu()
    {
        return config("{$this->name}.admin.menu.items");
    }

    /**
     * @param mixed $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
       return $this->enabled = true;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return mixed
     */
    public function getInstalled()
    {
        return $this->installed;
    }

    /**
     * @param mixed $installed
     */
    public function setInstalled($installed)
    {
        $this->installed = $installed;
    }

    /**
     * @return mixed
     */
    public function getLogPath()
    {
        return $this->log_path;
    }

    /**
     * @param mixed $log_path
     */
    public function setLogPath($log_path)
    {
        $this->log_path = $log_path;
    }







}
