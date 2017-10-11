<?php
namespace Dosarkz\LaravelAdmin\Install\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
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
