<?php
namespace Dosarkz\Lora;

class LoraRepository
{
    const VIEW_GROUP_NAME = 'lora';

    public $viewPath = 'layouts.app';
    public $authViewPath = 'layouts.login';

    public function getLayoutPath() : string
    {
        return $this->getViewPath($this->viewPath);
    }

    public function getAuthLayoutPath() : string
    {
        return $this->getViewPath($this->authViewPath);
    }

    /**
     * @param $route
     * @return string
     */
    public function renderView($route) : string
    {
        return view($this->getViewPath($route));
    }

    public function getRoutePath($route)
    {
        return $this->getViewPath($route);
    }

    /**
     * @param $route
     * @param string $group
     * @return string
     */
    private function getViewPath($route, $group = self::VIEW_GROUP_NAME) : string
    {
        return sprintf("%s::%s", $group, $route);
    }
}
