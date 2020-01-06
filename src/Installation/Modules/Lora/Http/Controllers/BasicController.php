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

    /**
     * @param $route
     * @param array $data
     * @param array $mergedData
     * @return mixed
     */
    public function view($route, $data = [], $mergedData = [])
    {
        return Lora::renderView($route, $data, $mergedData);
    }
}
