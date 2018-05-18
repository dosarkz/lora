<?php

namespace Dosarkz\Dosmin\Commands;

use App\Modules\Article\Providers\ArticleServiceProvider;
use App\Modules\Menu\Providers\MenuServiceProvider;
use App\Modules\Role\Providers\RoleServiceProvider;
use App\Modules\SuperUser\Models\SuperUser;
use App\Modules\Role\Models\Role;
use App\Modules\SuperUser\Models\SuperUserRole;
use App\Modules\SuperUser\Providers\SuperUserServiceProvider;
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
            $this->info('4. Installing modules...');
            $this->installModules();
            $this->info('5. Create super user');
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
        $tags = [];

        if (!config('admin')) {
            $tags[] = 'config_admin_file';
        }else{
            $this->info("Config admin file already installed");
            if($this->confirm('Do you need update a file?'))
            {
                $tags[] = 'config_admin_file';
            }
        }

        if(is_dir(public_path('vendor/admin')))
        {
            $this->info("Admin assets already installed");
            if($this->confirm('Do you need update assets of admin plugins?'))
            {
                $tags[] = 'admin';
            }
        }

        if(is_dir(app_path('Modules/SuperUser')))
        {
            $this->info("Super User module already installed");
            if($this->confirm('Do you need install again Super User?'))
            {
                $tags[] = 'super_user_module';
            }
        }else{
            $tags[] = 'super_user_module';
        }

        if(is_dir(app_path('Modules/Menu')))
        {
            $this->info("Menu module already installed");
            if($this->confirm('Do you need install again Menu?'))
            {
                $tags[] = 'menu_module';
            }
        }else{
            $tags[] = 'menu_module';
        }

        if(is_dir(app_path('Modules/Role')))
        {
            $this->info("Role module already installed");
            if($this->confirm('Do you need install again Role?'))
            {
                $tags[] = 'role_module';
            }
        }else{
            $tags[] = 'role_module';
        }

        if(is_dir(app_path('Modules/Article')))
        {
            $this->info("Article module already installed");
            if($this->confirm('Do you need install again Article?'))
            {
                $tags[] = 'article_module';
            }
        }else{
            $tags[] = 'article_module';
        }

        if(is_dir(app_path('Modules/Image')))
        {
            $this->info("Image module already installed");
            if($this->confirm('Do you need install again Image?'))
            {
                $tags[] = 'image_module';
            }
        }else{
            $tags[] = 'image_module';
        }

        if(count($tags) > 0)
        {
            $this->call('vendor:publish', [
                '--tag'   => $tags,
                '--force' => true
            ]);
        }

        $this->info('Publish vendor was transferred successfully');
    }

    public function createSuperUser()
    {
        DB::table('super_users')->truncate();
        DB::table('super_users')->delete();

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
            '--class' => 'App\\Modules\\Role\\Database\\Seeders\\ModuleSeeder'
        ]);
        $this->call('db:seed', [
            '--class' => 'Dosarkz\\Dosmin\\Database\\Seeders\\ModulesSeeder'
        ]);
        $this->call('db:seed', [
            '--class' => 'App\\Modules\\Menu\\Database\\Seeders\\MenuSeeder'
        ]);

    }

    public function installModules()
    {
        if(is_null(config('admin.modules.providers')))
        {
            $modules = [];
        }else {
            $modules = config('admin.modules.providers');
        }

        foreach ($modules as $module => $path) {
            $this->call('module:install', ['module' => $module]);
        }
    }


}
