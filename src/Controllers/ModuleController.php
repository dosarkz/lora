<?php namespace Dosarkz\LaravelAdmin\Controllers;

use App\Http\Controllers\Controller;

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
     * @param mixed $module
     */
    public function setModule($module)
    {
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