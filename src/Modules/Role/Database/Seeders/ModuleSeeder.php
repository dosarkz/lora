<?php
namespace Dosarkz\Dosmin\Modules\Role\Database\Seeders;

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
            'name' => 'Администратор',
            'alias' => 'admin',
            'status_id' => 1
        ]);

        DB::table('roles')->insert([
            'name' => 'Менеджер',
            'alias' => 'manager',
            'status_id' => 1
        ]);


        DB::table('roles')->insert([
            'name' => 'Пользователь',
            'alias' => 'user',
            'status_id' => 1
        ]);

    }
}