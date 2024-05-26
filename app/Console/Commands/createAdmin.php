<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class createAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $admin = User::create([
            "name" => "Admin",
            "email" => "admin@admin.com",
            "password" => bcrypt("password"),
        ]);

        $this->info("Admin created successfully");
    }
}
