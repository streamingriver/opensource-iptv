<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sriptv:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Must run on every deploy';

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
     * @return int
     */
    public function handle()
    {
        if(env("DB_CONNECTION") == "sqlite") {
            if(!file_exists(env("DB_DATABASE"))) {
                touch(env("DB_DATABASE"));
            }
        }

        if(env("APP_KEY") == "") {
            Artisan::call("key:generate --force");
        }
        
        Artisan::call("migrate --seed --force");
        
        return Command::SUCCESS;
    }
}
