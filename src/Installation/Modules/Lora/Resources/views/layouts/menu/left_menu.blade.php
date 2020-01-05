<ul class="sidebar-menu">
    <li class="header">{{trans('lora::base.navigation')}}</li>
    @include('lora::navigation.menu',[
    'lists'=> \Dosarkz\Lora\Installation\Modules\Lora\Models\Menu::where('type_id', 1)
        ->visible()
        ->orderBy('position')
        ->get()
        ])


</ul>
