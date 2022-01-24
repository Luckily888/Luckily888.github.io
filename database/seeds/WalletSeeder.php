<?php

use App\Model\Currency;
use App\Model\Wallet;
use Illuminate\Database\Seeder;
class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = Currency::all();
        foreach ($currencies as $currency){
            Wallet::create([
                'uid' => 1,
                'currency' => $currency->id,
                'address' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
