<?php

namespace GovindTomar\Permission\Commands;

use Illuminate\Console\Command;
use GovindTomar\Permission\Database\Seeders\RoleSeeder;

class Permission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install permission seeder';

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

        dd('gggg');

        $role = new RoleSeeder;
        $role->run();
    }
}
