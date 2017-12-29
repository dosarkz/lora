<?php

namespace Dosarkz\LaravelAdmin\Commands;

use Dosarkz\LaravelAdmin\Models\Module;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ModuleInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:install {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the module';

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

            if(!is_dir(app_path('Modules/'.ucfirst($this->argument('module')))))
            {
                return   $this->error('Module not found');
            }

            $this->info("Installing {$this->argument('module')} module...");

            $this->info('1. Copy publish files');
            $this->publishFiles($this->argument('module'));
            $this->info('2. Running migration');
            $this->call('migrate');

            $module = Module::where('alias', strtolower($this->argument('module')))->first();

            if(!$module)
            {
                Module::create([
                    'name_ru' =>  $this->argument('module'),
                    'name_en' => $this->argument('module'),
                    'menu_active' => true,
                    'description_ru' => $this->argument('module'),
                    'description_en' => $this->argument('module'),
                    'version' =>  0.01,
                    'status_id' => 1,
                    'alias' => strtolower($this->argument('module')),
                    'installed' => true,
                ]);
            }
            $this->info('3. Running seeder');
            $this->databaseSeeder();
            $this->info('Installation was successful');
            return true;

        } catch (\Exception $e) {
            print $e;
            die("Could not connect to the database.  Please check your configuration.");
        }
    }

    /**
     *  Copy master template to resource/view
     */
    public function publishFiles($module)
    {
        $this->callSilent('vendor:publish', [
            '--tag'   => [$module],
            '--force' => true
        ]);
        $this->info('Publish vendor was transferred successfully');
    }

    public function databaseSeeder()
    {
        if(file_exists(app_path('Modules/'.ucfirst($this->argument('module')).'/Database/Seeders/ModuleSeeder.php')))
        {
            Artisan::call('db:seed', [
                '--class' => 'App\\Modules\\'.ucfirst($this->argument('module')).'\\Database\\Seeders\\ModuleSeeder'
            ]);
        }
    }




}
