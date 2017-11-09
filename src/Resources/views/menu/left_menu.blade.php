<ul class="sidebar-menu">
    <li class="header">Навигация</li>
    <li>
        <a href="/admin">
            <i class="fa fa-dashboard"></i> <span>Главная</span>
        </a>
    </li>

    <li>
        <a href="/admin/modules">
            <i class="fa fa-th-large"></i> <span>Модули</span>
        </a>
    </li>


    @include('admin::navigation.menu',['lists'=> app()->modules->menu()])


</ul>