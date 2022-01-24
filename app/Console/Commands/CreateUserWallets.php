<?php

namespace App\Console\Commands;

use App\Model\Currency;
use App\Model\Wallet;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class CreateUserWallets extends Command
{
    protected $signature = 'wallet:create-user-wallet {user_id}';

    protected $description = 'For create all user wallets';

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
     * @return mixed
     */
    public function handle()
    {
        $user = User::find($this->argument('user_id'));
        if (!$user){
            if (app()->runningInConsole()){
                echo 'not found user';
            }
            return false;
        }

        $currencies = Currency::get();
        foreach ($currencies as $c){
            $wallet = Wallet::where('uid', $user->id)
                ->where('currency', $c->id)
                ->first();
            if (!$wallet){
                $wallet = new Wallet();
                $wallet->uid = $user->id;
                $wallet->currency = $c->id;
                if ($c->isERC20){
                    $eth = Currency::where('symbol', 'eth')->first();
                    $userEth = Wallet::whereUid($user->id)->where('currency', $eth->id)->first();
                    $wallet->address = $userEth?$userEth->address:null;
                }
                $wallet->save();

                if (app()->runningInConsole()){
                    echo 'user: ' . $user->id . ' currency_id: ' . $c->id . "\n";
                }
            }
        }
    }
}
