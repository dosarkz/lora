<?php
namespace Dosarkz\Lora\Repositories;

use Countable;
use Dosarkz\Lora\Models\Module;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use Dosarkz\Lora\Contracts\RepositoryInterface;
use Dosarkz\Lora\Exceptions\ModuleNotFoundException;

class Repository implements RepositoryInterface
{
    use Macroable;

    /**
     * Application instance.
     *
     */
    protected $app;

    /**
     * The module path.
     *
     * @var string|null
     */
    protected $path;

    /**
     * The scanned paths.
     *
     * @var array
     */
    protected $paths = [];

    /**
     * @var string
     */
    protected $stubPath;
    /**
     * @var array
     */
    protected $providers;

    /**
     * Repository constructor.
     * @param Container $app
     * @param $providers
     */
    public function __construct(Container $app, $providers)
    {
        $this->app = $app;
        $this->providers = $providers;
    }


    public function scan()
    {
        $modules = [];

        foreach ($this->providers as $module_name => $provider) {
            $this->app->register($provider);
            if($module = Module::where('alias', $module_name)->first())
            {
                if(!$module->installed)
                {
                    $this->installModule($module_name);
                }
            }else{
                $module = Module::create([
                    'alias' => $module_name,
                    'name_en' => $module_name
                ]);
            }


            $modules[] = $module;
        }

        return $modules;
    }

    public function menu()
    {
        $menus = [];

        foreach ($this->all() as $item) {
            if(config("{$item->getName()}.admin.menu.active"))
                $menus = $item->getMenu();
        }

       return $menus;
    }

    private function installModule($module_name)
    {
        Artisan::call("module:install", ['module' => $module_name]);
    }

    /**
     * {@inheritdoc}
     */
    protected function formatCached($cached)
    {
        $modules = [];

        foreach ($cached as $name => $module) {
            $path = $this->config('paths.modules') . '/' . $name;

            $modules[$name] = new Module($this->app, $name, $path);
        }

        return $modules;
    }




    /**
     * Add other module location.
     *
     * @param string $path
     *
     * @return $this
     */
    public function addLocation($path)
    {
        $this->paths[] = $path;

        return $this;
    }

    /**
     * Alternative method for "addPath".
     *
     * @param string $path
     *
     * @return $this
     * @deprecated
     */
    public function addPath($path)
    {
        return $this->addLocation($path);
    }

    /**
     * Get all additional paths.
     *
     * @return array
     */
    public function getPaths() : array
    {
        return $this->paths;
    }


    /**
     * Get all modules.
     *
     * @return array
     */
    public function all() : array
    {
        if (!$this->config('cache.enabled')) {
            return $this->scan();
        }

        return $this->formatCached($this->getCached());
    }

    /**
     * Get a module path.
     *
     * @return string
     */
    public function getPath() : array
    {
        return $this->path ?: $this->config('paths.modules', base_path('Modules'));
    }

    /**
     * Register the modules.
     */
    public function register()
    {
        foreach ($this->getOrdered() as $module) {
            $module->register();
        }
    }

    /**
     * Boot the modules.
     */
    public function boot()
    {
        foreach ($this->getOrdered() as $module) {
            $module->boot();
        }
    }

    /**
     * Find a specific module.
     * @param $name
     * @return mixed|void
     */
    public function find($name)
    {
        foreach ($this->all() as $module) {
            if ($module->getLowerName() === strtolower($name)) {
                return $module;
            }
        }

        return;
    }

    /**
     * Find a specific module by its alias.
     * @param $alias
     * @return mixed|void
     */
    public function findByAlias($alias)
    {
        foreach ($this->all() as $module) {
            if ($module->getAlias() === $alias) {
                return $module;
            }
        }

        return;
    }


    /**
     * Alternative for "find" method.
     * @param $name
     * @return mixed|void
     * @deprecated
     */
    public function get($name)
    {
        return $this->find($name);
    }

    /**
     * Find a specific module, if there return that, otherwise throw exception.
     *
     * @param $name
     *
     * @return Module
     *
     * @throws ModuleNotFoundException
     */
    public function findOrFail($name)
    {
        $module = $this->find($name);

        if ($module !== null) {
            return $module;
        }

        throw new ModuleNotFoundException("Module [{$name}] does not exist!");
    }


    /**
     * Get module path for a specific module.
     *
     * @param $module
     *
     * @return string
     */
    public function getModulePath($module)
    {
        try {
            return $this->findOrFail($module)->getPath() . '/';
        } catch (ModuleNotFoundException $e) {
            return $this->getPath() . '/' . Str::studly($module) . '/';
        }
    }

    /**
     * Get asset path for a specific module.
     *
     * @param $module
     *
     * @return string
     */
    public function assetPath($module) : string
    {
        return $this->config('paths.assets') . '/' . $module;
    }

    /**
     * Get a specific config data from a configuration file.
     *
     * @param $key
     *
     * @param null $default
     * @return mixed
     */
    public function config($key, $default = null)
    {
        return $this->app['config']->get('modules.' . $key, $default);
    }
}
