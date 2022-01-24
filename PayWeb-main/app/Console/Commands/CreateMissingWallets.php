<?php

namespace App\Console\Commands;

use App\Model\Currency;
use App\Model\Wallet;
use App\User;
use Illuminate\Console\Command;
use function foo\func;

class CreateMissingWallets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wallet:create-missing-wallet {currency_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user missing wallet' ;

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
        $currency = Currency::find($this->argument('currency_id'));
        if (!$currency){
            if (app()->runningInConsole()){
                echo 'not found currency';
            }
            return false;
        }

        $missingUsers = User::leftJoin('wallets', function($join) use ($currency){
            $join->on('users.id', '=', 'wallets.uid')
                ->where('wallets.currency', $currency->id);
        })
            ->whereNull('wallets.id')
            ->select('users.id')
            ->groupBy('users.id')
            ->get();

        foreach ($missingUsers as $aUser) {

            $wallet = new Wallet();
            $wallet->uid = $aUser->id;
            $wallet->currency = $currency->id;
            if ($currency->isERC20){
                $eth = Currency::where('symbol', 'eth')->first();
                $userEth = Wallet::whereUid($aUser->id)->where('currency', $eth->id)->first();
                $wallet->address = $userEth?$userEth->address:null;
            }
            $wallet->save();

            if (app()->runningInConsole()){
                echo 'user: ' . $aUser->id . ' currency_id: ' . $currency->id . "\n";
            }
        }

        return true;
    }
}
