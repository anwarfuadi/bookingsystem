<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'hp' => '087654321',
            'email' => 'admin@bananastore.okok',
            'password' => Hash::make('password'),
            'level' => 'admin'
        ]);
    }
}
