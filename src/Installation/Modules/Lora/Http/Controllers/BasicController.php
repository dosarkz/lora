<?php
namespace Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers;

use App\Http\Controllers\Controller;
use Dosarkz\Lora\Facade\Lora;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Module;

class BasicController extends Controller
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
     * @var
     */
    protected $view;

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

    public function view($route)
    {
        return Lora::renderView($route);
    }



}
