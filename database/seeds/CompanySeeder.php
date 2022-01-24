<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            0 =>
                [
                    "id" => 1,
                    "name" => "E-sports betting 123",
                    "activated" => 1,
                    "created_at" => "2019-02-26 13:05:00",
                    "updated_at" => null
                ],
            1 =>
                [
                    "id" => 2,
                    "name" => "Blue chip poker",
                    "activated" => 1,
                    "created_at" => "2019-02-26 13:05:00",
                    "updated_at" => null
                ],
            2 =>
                [
                    "id" => 3,
                    "name" => "Zeno suit",
                    "activated" => 0,
                    "created_at" => "2019-02-26 13:05:00",
                    "updated_at" => null
                ],
            3 =>
                [
                    "id" => 4,
                    "name" => "BATTLE ANGELS INPHIBIT ESPORTS",
                    "activated" => 1,
                    "created_at" => "2019-02-26 13:05:00",
                    "updated_at" => null
                ],
            4 =>
                [
                    "id" => 5,
                    "name" => "Vanilla Connect",
                    "activated" => 1,
                    "created_at" => "2019-02-26 13:05:00",
                    "updated_at" => null
                ]
        ]);
    }
}
