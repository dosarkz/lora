<?php
namespace App\Modules\Article\Database\Seeders;

use Dosarkz\Dosmin\Models\Module;
use Dosarkz\Dosmin\Modules\Menu\Models\Menu;
use Dosarkz\Dosmin\Modules\Menu\Models\MenuItem;
use Dosarkz\Dosmin\Modules\Menu\Models\MenuRole;
use Dosarkz\Dosmin\Modules\Role\Models\Role;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if($menu = Menu::where('name', 'Article')->first())
        {
            $menu->menuItems()->delete();
            $menu->menuRoles()->delete();
            $menu->delete();
        }

        $module =   Module::firstOrCreate([
                    'name_ru' =>  'Страницы',
                    'name_en' => 'Article',
                    'menu_active' => true,
                    'description_ru' => 'Article',
                    'description_en' => 'Article',
                    'version' =>  0.01,
                    'status_id' => Module::STATUS_NEW,
                    'alias' => strtolower('Article'),
                ]);

        $menu =   Menu::create([
            'name' => 'Article',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'module_id' => $module->id,
            'status_id' => 1,
            'position'  => 2,
        ]);

        $MenuItem =  MenuItem::create([
            'title_ru' => 'Страницы',
            'url' => '/admin/article',
            'icon' => 'fa-briefcase',
            'position' => 1,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Добавить',
            'url' => '/admin/article/create',
            'icon' => 'fa-plus-circle',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuItem::create([
            'title_ru' => 'Список',
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

        MenuRole::create([
            'role_id' => Role::where('alias', 'manager')->first()->id,
            'menu_id'   => $menu->id,
        ]);

    }
}
