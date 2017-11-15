<?php
namespace Dosarkz\LaravelAdmin\Modules\Menu\Database\Seeders;

use Dosarkz\LaravelAdmin\Models\Module;
use Dosarkz\LaravelAdmin\Modules\Menu\Models\Menu;
use Dosarkz\LaravelAdmin\Modules\Menu\Models\MenuItem;
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

    }
}
