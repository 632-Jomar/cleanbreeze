<?php

use App\User;
use App\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        UserType::firstOrCreate(['type_name' => 'Admin']);
        UserType::firstOrCreate(['type_name' => 'Sales']);
    }
}
