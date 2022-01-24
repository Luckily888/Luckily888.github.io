<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            "name" => "Admin",
            "email" => "admin@test.com",
            "password" => bcrypt("123456")
        ]);
    }
}
