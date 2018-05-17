<?php
namespace Dosarkz\Dosmin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesSeeder extends Seeder
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
            'name_ru' => 'Суперпользователи',
            'name_en' => 'Super User',
            'menu_active' => true,
            'description_ru' => 'Модуль для управления админами',
            'description_en' => 'The module to manage Super users',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'superUser',
            'installed' => true,
        ]);

        DB::table('modules')->insert([
            'name_ru' => 'Роли',
            'name_en' => 'Roles',
            'menu_active' => true,
            'description_ru' => 'Модуль для управления ролями',
            'description_en' => 'The module to manage Roles',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'role',
            'installed' => true,
        ]);

        DB::table('modules')->insert([
            'name_ru' => 'Фото',
            'name_en' => 'Image',
            'menu_active' => true,
            'description_ru' => 'Модуль для управления изображениями',
            'description_en' => 'The module to manage Image',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'moduleImage',
            'installed' => true,
        ]);

        DB::table('modules')->insert([
            'name_ru' => 'Меню',
            'name_en' => 'Menu',
            'menu_active' => true,
            'description_ru' => 'Модуль для управления меню',
            'description_en' => 'The module to manage Menu',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'menu',
            'installed' => true,
        ]);

        DB::table('modules')->insert([
            'name_ru' =>  'Страницы',
            'name_en' => 'Article',
            'menu_active' => true,
            'description_ru' => 'Article',
            'description_en' => 'Article',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'article',
        ]);
    }
}
