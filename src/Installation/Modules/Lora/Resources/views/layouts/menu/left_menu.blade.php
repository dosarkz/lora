<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    @include('lora::navigation.menu',[
    'lists'=> \Dosarkz\Lora\Installation\Modules\Lora\Models\Menu::where('type_id', 1)
        ->visible()
        ->orderBy('position')
        ->get()
        ])
</ul>
