<?php namespace Dosarkz\LaravelAdmin\Controllers;

use App\Http\Controllers\Controller;
use Dosarkz\LaravelAdmin\Exceptions\ModuleNotFoundException;
use Dosarkz\LaravelAdmin\Models\Module;

/**
 * Class ModuleController
 * @package Dosarkz\LaravelAdmin\Controllers
 */
class ModuleController extends Controller
{
    /**
     * @var
     */
    private $module;
    /**
     * @var
     */
    protected $model;

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param $module_alias
     * @return ModuleNotFoundException
     */
    public function setModule($module_alias)
    {
        $module =  Module::where('alias', $module_alias)->first();

        if(!$module)
        {
            return new ModuleNotFoundException($module_alias);
        }

        $this->module = $module;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
}