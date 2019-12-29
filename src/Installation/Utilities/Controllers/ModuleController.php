<?php namespace Dosarkz\Lora\Controllers;

use App\Http\Controllers\Controller;
use Dosarkz\Lora\Exceptions\ModuleNotFoundException;
use Dosarkz\Lora\Models\Module;

/**
 * Class ModuleController
 * @package Dosarkz\Lora\Controllers
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
            return app()->abort(400, 'Module with slug name [' . $module_alias . '] not found');
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
