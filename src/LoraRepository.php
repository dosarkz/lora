<?php
namespace Dosarkz\Lora;

class LoraRepository
{
    public $viewPath = 'layouts.app';
    public $groupName = 'lora';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function layout()
    {
        return $this->renderView($this->viewPath);
    }

    /**
     * @param $route
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function renderView($route)
    {
        return view(sprintf("%s::%s", $this->groupName, $route));
    }
}
