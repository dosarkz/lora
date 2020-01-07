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
            'name_ru' => 'Системный модуль Lora',
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
            'url' => route('menus.index'),
            'icon' => 'fa-bars',
            'position' => 1,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Список меню',
            'title_en'  =>  'List',
            'url' => route('menus.index'),
            'icon' => 'fa-list-ul',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Добавить',
            'title_en'  =>  'Add',
            'url' => route('menus.create'),
            'icon' => 'fa-plus-circle',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        $main =   Menu::create([
            'name_ru' => 'Панель инструментов',
            'name_en'   =>  'Dashboard',
            'alias' =>  'dashboard',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'status_id' => 1,
            'position'  => 1,
        ]);

        MenuItem::create([
            'title_ru' => 'Панель инструментов',
            'title_en'  =>  'Dashboard',
            'url' => route('lora.dashboard.index'),
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
            'menu_id'   => $main->id,
        ]);

        MenuRole::create([
            'role_id' => Role::where('alias', 'manager')->first()->id,
            'menu_id'   => $main->id,
        ]);

        $menu =   Menu::create([
            'name_en' => 'Account management',
            'name_ru'   =>  'Управление аккаунтом',
            'alias' =>  'account',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'module_id' => null,
            'status_id' => 1,
            'position'  => 2,
        ]);

          MenuItem::create([
            'title_ru' => 'Настройки',
            'title_en'  =>  'Settings',
            'url' => route('lora.account.settings.show'),
            'icon' => 'fa-briefcase',
            'position' => 1,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);


        $MenuItem =  MenuItem::create([
            'title_ru' => 'Роли',
            'title_en'  =>  'Roles',
            'url' => route('roles.index'),
            'icon' => 'fa-briefcase',
            'position' => 1,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Добавить',
            'title_en'  =>  'Add',
            'url' => route('roles.create'),
            'icon' => 'fa-plus-circle',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Список',
            'title_en'  =>  'List',
            'url' => route('roles.index'),
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
