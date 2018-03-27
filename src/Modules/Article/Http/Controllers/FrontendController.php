<?php

namespace Dosarkz\Dosmin\Modules\Article\Http\Controllers;

use Dosarkz\Dosmin\Controllers\ModuleController;
use Dosarkz\Dosmin\Modules\Article\Models\Article;

class FrontendController extends ModuleController
{
    /**
     * @var string
     */
    private $viewPath = 'article::frontend.show';

    public function __construct()
    {
        $this->setModule('article');
        $this->setModel(new Article());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('article::frontend.index');
    }

    /**
     * @param $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($alias)
    {
        $model = $this->model->where('url', $alias)->first();

        return view($model->view_path ? $model->view_path : $this->viewPath, compact('model'));
    }
}
