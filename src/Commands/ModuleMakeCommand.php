<?php

namespace Dosarkz\Dosmin\Commands;

use Dosarkz\Dosmin\Generators\ModuleGenerator;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ModuleMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make the new module';

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

            $module_name = ucfirst($this->argument('module'));

            if(is_dir(app_path('Modules/'.$module_name)))
            {
               return  $this->error('This module already created');
            }

            $this->info("Creating {$module_name} module...");

            $this->generateModule($module_name);

            $this->call('module:install',[
                'module'  => $module_name
            ]);

            $this->info('Installation was successful');
            $this->info('Please include ServiceProvider for initial module to the config file, config/admin.php');
            $this->info("'".lcfirst($module_name)."' =>  \App\Modules\\$module_name\Providers\\$module_name"."ServiceProvider::class");



            return true;

        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die("Could not connect to the database.  Please check your configuration.");
        }
    }


    private function generateModule($moduleName)
    {
        $generator = new ModuleGenerator($moduleName, new Filesystem(), $this);
        $generator->generate();

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


    function replace_string_in_file($filename, $string_to_replace, $replace_with){
        $content=file_get_contents($filename);
        $content_chunks=explode($string_to_replace, $content);
        $content=implode($replace_with, $content_chunks);
        file_put_contents($filename, $content);
    }

}
