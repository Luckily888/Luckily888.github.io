<?php

use App\User;
use Illuminate\Database\Seeder;

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
            "name" => "User",
            "email" => "user@email.com",
            "password" => bcrypt("123456")
        ]);
    }
}
