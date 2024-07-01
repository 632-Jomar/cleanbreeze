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
        User::create([
            'name'         => 'Jomar Alarcon',
            'email'        => 'jalarcon.632apps@gmail.com',
            'password'     => Hash::make('supercell5'),
            'user_type_id' => 1
        ]);

        User::create([
            'name'         => 'Sales User',
            'email'        => 'sales@gmail.com',
            'password'     => Hash::make('sales'),
            'user_type_id' => 2
        ]);

        UserType::firstOrCreate(['type_name' => 'Admin']);
        UserType::firstOrCreate(['type_name' => 'Sales']);
    }
}
