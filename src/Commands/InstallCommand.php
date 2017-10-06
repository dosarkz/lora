<?php

namespace Dosarkz\LaravelAdmin\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InstallCommand extends Command
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
            $this->call('migrate');

            return true;

        } catch (\Exception $e) {
            print $e;
            die("Could not connect to the database.  Please check your configuration.");
        }


    }
}
