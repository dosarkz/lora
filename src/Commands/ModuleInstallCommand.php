<?php

namespace Dosarkz\LaravelAdmin\Commands;

use Illuminate\Console\Command;
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


            $this->info("Installing {$this->argument('module')} module...");

            $this->info('1. Copy publish files');
            $this->publishFiles($this->argument('module'));
            $this->info('2. Running migration');
            $this->call('migrate');
//            $this->info('3. Running seeder');
//            $this->databaseSeeder();
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
        $this->call('db:seed', [
            '--class' => 'Dosarkz\\LaravelAdmin\\Modules\\Role\\Database\\Seeders\\RoleSeeder'
        ]);
    }


}