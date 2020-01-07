<?php

namespace Dosarkz\Lora\Commands;

use Dosarkz\Lora\Installation\Modules\Lora\Models\SuperUser;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Role;
use Dosarkz\Lora\Installation\Modules\Lora\Models\SuperUserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LoraInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lora:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the lora package';

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

            $this->info('Installing Lora...');

            $this->info('1. Copy publish files');
            $this->publishFiles();
            $this->info('2. Running migration');
            $this->call('migrate');
            $this->info('3. Running seeder');
            $this->databaseSeeder();
            $this->info('4. Installing modules...');
            $this->installModules();
            $this->info('5. Create admin user');
            $this->createSuperUser();
            $this->info('Installation was successful. Visit your_domain.com/admin to access admin panel');
            return true;

        } catch (\Exception $e) {
            print $e;
            die("Installation failed");
        }
    }

    /**
     *  Copy master template to resource/view
     */
    public function publishFiles()
    {
        $this->callSilent('vendor:publish', [
            '--tag' => ['lora'],
            //  '--force' => true
        ]);
        $this->info('Publish vendor transferred successfully');
    }

    public function createSuperUser()
    {
        $admin = new SuperUser();
        $role_admin = Role::where('alias', 'admin')->first();
        if (!$role_admin) return false;

        $admin->username = $this->ask('Administrator login', 'admin');
        $admin->name = $this->ask('Administrator name', 'Lora');
        $admin->email = $this->ask('Administrator email', 'ashenov.e@gmail.com');
        $admin->password = bcrypt($this->secret('Administrator password'));
        $admin->role_id = $role_admin->id;

        if (!$user = SuperUser::where('username', $admin->username)->orWhere('email', $admin->email)->first()) {
            $admin->save();
            $user = $admin;
        }

        SuperUserRole::create([
            'super_user_id' => $user->id,
            'role_id' => $role_admin->id,
        ]);

        $this->info('Lora User has been created');
    }

    public function databaseSeeder()
    {
        $this->call('db:seed', [
            '--class' => 'Dosarkz\\Lora\\Installation\\Modules\\Lora\\Database\\Seeders\\ModuleSeeder'
        ]);
    }

    public function installModules()
    {
        if (is_null(config('lora.modules.providers'))) {
            $modules = [];
        } else {
            $modules = config('lora.modules.providers');
        }

        foreach ($modules as $module => $path) {
            $this->call('module:install', ['module' => $module]);
        }
    }


}
