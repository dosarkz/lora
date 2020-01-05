<?php
namespace Dosarkz\Lora\Installation\Utilities\Composers;
use Dosarkz\Lora\Facade\Lora;
use Illuminate\View\View;

class LayoutComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'layoutPath' => Lora::getLayoutPath(),
            'authLayoutPath' => Lora::getAuthLayoutPath(),
        ]);
    }
}
