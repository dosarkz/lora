<?php
namespace App\Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

    }
}
