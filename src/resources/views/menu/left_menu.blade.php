<ul class="sidebar-menu">
    <li class="header">Навигация</li>
    @include('admin::navigation.menu',[
    'lists'=> \Dosarkz\LaravelAdmin\Modules\Menu\Models\Menu::where('type_id', 1)
        ->visible()
        ->orderBy('position')
        ->get()
        ])


</ul>