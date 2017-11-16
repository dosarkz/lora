<?php
namespace Dosarkz\LaravelAdmin\Modules\Menu\Database\Seeders;

use Dosarkz\LaravelAdmin\Models\Module;
use Dosarkz\LaravelAdmin\Modules\Menu\Models\Menu;
use Dosarkz\LaravelAdmin\Modules\Menu\Models\MenuItem;
use Dosarkz\LaravelAdmin\Modules\Menu\Models\MenuRole;
use Dosarkz\LaravelAdmin\Modules\Role\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();
        DB::table('menus')->delete();

        DB::table('menu_items')->truncate();
        DB::table('menu_items')->delete();

        $menu =   Menu::create([
            'name' => 'Меню',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'module_id' => Module::where('alias', 'menu')->first()->id,
            'status_id' => 1,
            'position'  => 2,
        ]);



        $MenuItem =  MenuItem::create([
            'title_ru' => 'Меню',
            'url' => '/admin/menu',
            'icon' => 'fa-bars',
            'position' => 1,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Список меню',
            'url' => '/admin/menu',
            'icon' => 'fa-list-ul',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);


        $modules =   Menu::create([
            'name' => 'Модули',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'status_id' => 1,
            'position'  => 3,
        ]);


        MenuItem::create([
            'title_ru' => 'Модули',
            'url' => '/admin/modules',
            'icon' => 'fa-th-large',
            'menu_id' => $modules->id,
            'position' => 1,
            'status_id' => 1
        ]);

        $main =   Menu::create([
            'name' => 'Главная',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'status_id' => 1,
            'position'  => 1,
        ]);



      MenuItem::create([
            'title_ru' => 'Главная',
            'url' => '/admin',
            'icon' => 'fa-dashboard',
            'menu_id' => $main->id,
            'position' => 1,
            'status_id' => 1
        ]);


        MenuRole::create([
            'role_id' => Role::where('alias', 'admin')->first()->id,
            'menu_id'   => $menu->id,
        ]);

        MenuRole::create([
            'role_id' => Role::where('alias', 'admin')->first()->id,
            'menu_id'   => $modules->id,
        ]);


         MenuRole::create([
            'role_id' => Role::where('alias', 'admin')->first()->id,
            'menu_id'   => $main->id,
        ]);

        MenuRole::create([
            'role_id' => Role::where('alias', 'manager')->first()->id,
            'menu_id'   => $main->id,
        ]);

    }
}