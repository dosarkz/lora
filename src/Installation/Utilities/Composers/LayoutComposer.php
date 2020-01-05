<?php
namespace Dosarkz\Lora\Installation\Utilities\Composers;
use Dosarkz\Lora\Facade\Lora;
use Illuminate\View\View;

class LayoutComposer
{
    public $template;

    public function __construct()
    {
        $this->template = Lora::layout();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('template', $this->template);
    }
}
