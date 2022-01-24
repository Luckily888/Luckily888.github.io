<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
                0 =>
                    [
                        'name' => 'Bitcoin',
                        'symbol' => 'btc'
                    ],
                1 =>
                    [
                        'name' => 'Bluechip Token',
                        'symbol' => 'blu'
                    ],
                2 =>
                    [
                        'name' => 'XRP',
                        'symbol' => 'xrp'
                    ],
                3 =>
                    [
                        'name' => 'Ethereum',
                        'symbol' => 'eth'
                    ],
                4 =>
                    [
                        'name' => 'Lite Coin',
                        'symbol' => 'ltc'
                    ],
                5 =>
                    [
                        'name' => 'EOS',
                        'symbol' => 'eos'
                    ],
                6 =>
                    [
                        'name' => 'Bitcoin cash',
                        'symbol' => 'bch'
                    ],
                7 =>
                    [
                        'name' => 'CBD Token',
                        'symbol' => 'cbd'
                    ]
        ]);
    }
}
