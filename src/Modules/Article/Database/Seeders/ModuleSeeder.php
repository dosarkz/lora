<?php
namespace App\Modules\Article\Database\Seeders;

use Dosarkz\Dosmin\Models\Module;
use App\Modules\Menu\Models\Menu;
use App\Modules\Menu\Models\MenuItem;
use App\Modules\Menu\Models\MenuRole;
use App\Modules\Role\Models\Role;
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
        if($menu = Menu::where('alias', 'article')->first())
        {
            $menu->menuItems()->delete();
            $menu->menuRoles()->delete();
            $menu->delete();
        }

        $menu =   Menu::create([
            'name_ru'   =>  'Страницы',
            'name_en' => 'Articles',
            'alias' =>  'articles',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'module_id' => Module::where('alias', 'article')->first()->id ?? null,
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
