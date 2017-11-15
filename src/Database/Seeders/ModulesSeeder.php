<?php
namespace Dosarkz\LaravelAdmin\Database\Seeders;

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
            'name_ru' => 'Модуль супер пользователя',
            'name_en' => 'Super User module',
            'menu_active' => true,
            'description_ru' => 'Модуль для управления админами',
            'description_en' => 'The module to manage Super users',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'superUser',
        ]);

        DB::table('modules')->insert([
            'name_ru' => 'Модуль ролей',
            'name_en' => 'Roles module',
            'menu_active' => true,
            'description_ru' => 'Модуль для управления ролями',
            'description_en' => 'The module to manage Roles',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'moduleRole',
        ]);

        DB::table('modules')->insert([
            'name_ru' => 'Модуль изображении',
            'name_en' => 'Image module',
            'menu_active' => true,
            'description_ru' => 'Модуль для управления изображениями',
            'description_en' => 'The module to manage Image',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'moduleImage',
        ]);

        DB::table('modules')->insert([
            'name_ru' => 'Модуль меню',
            'name_en' => 'Menu module',
            'menu_active' => true,
            'description_ru' => 'Модуль для управления меню',
            'description_en' => 'The module to manage Menu',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'menu',
        ]);
    }
}
