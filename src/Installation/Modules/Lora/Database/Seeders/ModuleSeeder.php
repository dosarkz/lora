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
            'alias' => 'accounts',
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

        $adminRole = Role::where('alias', 'admin')->first();
        $managerRole = Role::where('alias', 'manager')->first();

        $menu =   Menu::create([
            'name_ru' => 'Lora',
            'name_en'   =>  'Lora',
            'alias' =>  'lora',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'status_id' => 1,
            'position'  => 1,
        ]);


        MenuItem::create([
            'title_ru' => 'Панель инструментов',
            'title_en'  =>  'Dashboard',
            'url' => route('lora.dashboard.index',[], false),
            'icon' => 'fa-columns',
            'menu_id' => $menu->id,
            'position' => 1,
            'status_id' => 1
        ]);

        $menuItemLayoutSettings =  MenuItem::create([
            'title_ru' => 'Настроика шаблона',
            'title_en'  =>  'Layout settings',
            'url' => "#",
            'icon' => 'fa-bars',
            'position' => 2,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);

        $menuItem =  MenuItem::create([
            'title_ru' => 'Меню',
            'title_en'  =>  'Menu',
            'url' => route('lora.menus.index',[], false),
            'icon' => 'fa-bars',
            'position' => 1,
            'menu_id' => $menu->id,
            'parent_id' => $menuItemLayoutSettings->id,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Список меню',
            'title_en'  =>  'List',
            'url' => route('lora.menus.index',[], false),
            'icon' => 'fa-list-ul',
            'menu_id' => $menu->id,
            'parent_id' => $menuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Добавить',
            'title_en'  =>  'Add',
            'url' => route('lora.menus.create',[], false),
            'icon' => 'fa-plus-circle',
            'menu_id' => $menu->id,
            'parent_id' => $menuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        $accountManagementMenuItem = MenuItem::create([
            'title_ru' => 'Аккаунт',
            'title_en'  =>  'Account',
            'url' => route('lora.accounts.index', [], false),
            'icon' => 'fa-user',
            'position' => 3,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);

          MenuItem::create([
            'title_ru' => 'Пользователи',
            'title_en'  =>  'Super Users',
            'url' => route('lora.accounts.index',[], false),
            'icon' => 'fa-user',
            'position' => 1,
            'menu_id' => $menu->id,
            'parent_id' => $accountManagementMenuItem->id,
            'status_id' => 1
        ]);

        $MenuItem =  MenuItem::create([
            'title_ru' => 'Роли',
            'title_en'  =>  'Roles',
            'url' => route('lora.roles.index',[], false),
            'icon' => 'fa-user-circle',
            'position' => 1,
            'menu_id' => $menu->id,
            'parent_id' => $accountManagementMenuItem->id,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Добавить',
            'title_en'  =>  'Add',
            'url' => route('lora.roles.create',[], false),
            'icon' => 'fa-plus-circle',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Список',
            'title_en'  =>  'List',
            'url' => route('lora.roles.index', [], false),
            'icon' => 'fa-list-ul',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuRole::create([
            'role_id' =>  $adminRole->id,
            'menu_id'   => $menu->id,
        ]);

        MenuRole::create([
            'role_id' => $managerRole->id,
            'menu_id'   => $menu->id,
        ]);
    }
}
