<?php
namespace Dosarkz\Lora\Database\Seeders;

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
            'name_ru' => 'Модуль пользователя',
            'name_en' => 'Account module',
            'menu_active' => true,
            'description_ru' => 'Модуль для управления пользователями, ролями',
            'description_en' => 'The module to manage users, roles, permissions',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'account',
            'installed' => true,
        ]);

        DB::table('modules')->insert([
            'name_ru' => 'Модуль представления',
            'name_en' => 'Template module',
            'menu_active' => true,
            'description_ru' => 'Модуль для управления шаблонами, боковым меню',
            'description_en' => 'The module to manage users, roles, permissions',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'settings',
            'installed' => true,
        ]);

        DB::table('modules')->insert([
            'name_ru' => 'Модуль менеджера файлов',
            'name_en' => 'File manager module',
            'menu_active' => true,
            'description_ru' => 'Модуль для управления файлами и изображениями',
            'description_en' => 'The module to manage files and images',
            'version' =>  0.01,
            'status_id' => 1,
            'alias' => 'manager',
            'installed' => true,
        ]);

    }
}
