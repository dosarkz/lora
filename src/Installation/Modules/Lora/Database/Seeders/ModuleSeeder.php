<?php
namespace Dosarkz\Lora\Installation\Modules\Lora\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Dosarkz\Lora\Installation\Modules\Lora\Models\MenuItem;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Role;
use Dosarkz\Lora\Installation\Modules\Lora\Models\MenuRole;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Module;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Menu;


class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->truncate();
        DB::table('modules')->delete();

        DB::table('modules')->insert([
            'name_ru' => 'Системный модуль',
            'name_en' => 'Lora module',
            'menu_active' => true,
            'description_ru' => 'Системный модуль lora',
            'description_en' => 'The module lora',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'account',
            'installed' => true,
        ]);

        DB::table('roles')->truncate();
        DB::table('roles')->delete();

        DB::table('roles')->insert([
            'name_ru' => 'Администратор',
            'name_en'   =>  'Admin',
            'alias' => 'admin',
            'status_id' => 1
        ]);

        DB::table('roles')->insert([
            'name_ru' => 'Менеджер',
            'name_en'   =>  'Manager',
            'alias' => 'manager',
            'status_id' => 1
        ]);


        DB::table('roles')->insert([
            'name_ru' => 'Пользователь',
            'name_en'   =>  'User',
            'alias' => 'user',
            'status_id' => 1
        ]);


        DB::table('menus')->truncate();
        DB::table('menus')->delete();

        DB::table('menu_items')->truncate();
        DB::table('menu_items')->delete();

        $menu =   Menu::create([
            'name_ru' => 'Меню',
            'name_en'   =>  'Menu',
            'alias' =>  'menu',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'status_id' => 1,
            'position'  => 2,
        ]);

        $MenuItem =  MenuItem::create([
            'title_ru' => 'Меню',
            'title_en'  =>  'Menu',
            'url' => '/admin/menu',
            'icon' => 'fa-bars',
            'position' => 1,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Список меню',
            'title_en'  =>  'List',
            'url' => '/admin/menu',
            'icon' => 'fa-list-ul',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Добавить',
            'title_en'  =>  'Add',
            'url' => '/admin/menu/create',
            'icon' => 'fa-plus-circle',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        $modules =   Menu::create([
            'name_ru' => 'Модули',
            'name_en'   =>  'Modules',
            'alias' =>  'modules',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'status_id' => 1,
            'position'  => 3,
        ]);


        MenuItem::create([
            'title_ru' => 'Модули',
            'title_en'  =>  'Modules',
            'url' => '/admin/modules',
            'icon' => 'fa-th-large',
            'menu_id' => $modules->id,
            'position' => 1,
            'status_id' => 1
        ]);

        $main =   Menu::create([
            'name_ru' => 'Главная',
            'name_en'   =>  'Main',
            'alias' =>  'main',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'status_id' => 1,
            'position'  => 1,
        ]);



        MenuItem::create([
            'title_ru' => 'Главная',
            'title_en'  =>  'Main',
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

        $menu =   Menu::create([
            'name_en' => 'Roles',
            'name_ru'   =>  'Роли',
            'alias' =>  'role',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'module_id' => null,
            'status_id' => 1,
            'position'  => 2,
        ]);

        $MenuItem =  MenuItem::create([
            'title_ru' => 'Роли',
            'title_en'  =>  'Roles',
            'url' => '/admin/role',
            'icon' => 'fa-briefcase',
            'position' => 1,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Добавить',
            'title_en'  =>  'Add',
            'url' => '/admin/role/create',
            'icon' => 'fa-plus-circle',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Список',
            'title_en'  =>  'List',
            'url' => '/admin/role',
            'icon' => 'fa-list-ul',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuRole::create([
            'role_id' => Role::where('alias', 'admin')->first()->id,
            'menu_id'   => $menu->id,
        ]);



        $menu =   Menu::create([
            'name_ru'   =>  'Страницы',
            'name_en' => 'Articles',
            'alias' =>  'articles',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'status_id' => 1,
            'position'  => 2,
        ]);

        $MenuItem =  MenuItem::create([
            'title_ru' => 'Страницы',
            'title_en'  =>  'Articles',
            'url' => '/admin/article',
            'icon' => 'fa-file-text-o',
            'position' => 1,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Добавить',
            'title_en'  =>  'Add',
            'url' => '/admin/article/create',
            'icon' => 'fa-plus-circle',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Список',
            'title_en'  =>  'List',
            'url' => '/admin/article',
            'icon' => 'fa-list-ul',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuRole::create([
            'role_id' => Role::where('alias', 'admin')->first()->id,
            'menu_id'   => $menu->id,
        ]);


    }
}
