<?php

namespace Dosarkz\LaravelAdmin\Commands;

use Dosarkz\LaravelAdmin\Modules\SuperUser\Models\SuperUser;
use Dosarkz\LaravelAdmin\Modules\Role\Models\Role;
use Dosarkz\LaravelAdmin\Modules\SuperUser\Models\SuperUserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AdminInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the admin package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            DB::connection()->getPdo();

            $this->info('Installing Laravel Admin...');

            $this->info('1. Copy publish files');
            $this->publishFiles();
            $this->info('2. Running migration');
            $this->call('migrate:refresh');
            $this->info('3. Running seeder');
            $this->databaseSeeder();
            $this->info('3. Create super user');
            $this->createSuperUser();
            $this->info('Installation was successful. Visit your_domain.com/admin to access admin panel');
            return true;

        } catch (\Exception $e) {
            print $e;
            die("Could not connect to the database.  Please check your configuration.");
        }
    }

    /**
     *  Copy master template to resource/view
     */
    public function publishFiles()
    {
        $this->callSilent('vendor:publish', [
            '--tag'   => ['admin'],
            '--force' => true
        ]);
        $this->info('Publish vendor was transferred successfully');
    }

    public function createSuperUser()
    {
        $data['username']     = $this->ask('Administrator login', 'admin');
        $data['name'] = $this->ask('Admin name', 'Admin');
        $data['email']    = $this->ask('Administrator email', 'ashenov.e@gmail.com');
        $data['password'] = bcrypt($this->secret('Administrator password','123456'));
        $role_admin = Role::where('alias', 'admin')->first();
        $data['role_id']  = $role_admin->id;
        $user = SuperUser::create($data);

        SuperUserRole::create([
            'super_user_id' => $user->id,
            'role_id' => $role_admin->id,
        ]);

        $this->info('Admin User has been created');
    }

    public function databaseSeeder()
    {
        $this->call('db:seed', [
            '--class' => 'Dosarkz\\LaravelAdmin\\Modules\\Role\\Database\\Seeders\\RoleSeeder'
        ]);
        $this->call('db:seed', [
            '--class' => 'Dosarkz\\LaravelAdmin\\Database\\Seeders\\ModulesSeeder'
        ]);
        $this->call('db:seed', [
            '--class' => 'Dosarkz\\LaravelAdmin\\Modules\\Menu\\Database\\Seeders\\MenuSeeder'
        ]);

    }


}
