<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Currency;

class UpdatePrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:updatePrices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update last price to db.';

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
        $currencies = Currency::where('isERC20', 0)
            ->where('isDevvio', 0)
            ->get();
        foreach ($currencies as $currency){
            $client = new \GuzzleHttp\Client(['http_errors' => false]);
            $requestUrl = "https://api.coinbase.com/v2/exchange-rates?currency=".$currency->symbol;
            $request = $client->request('GET', $requestUrl,[]);
            if ($request->getStatusCode() == 200){
                $data = $request->getBody()->getContents();
                $data = \GuzzleHttp\json_decode($data);
                Currency::where('id',$currency->id)->update(['conversion' => $data->data->rates->USD]);
            }
        }

        $currencies = Currency::where('symbol_api','!=',null)->get();
        foreach ($currencies as $currency){
            $client = new \GuzzleHttp\Client(['http_errors' => false]);
            $requestUrl = "https://api.coinbase.com/v2/exchange-rates?currency=".$currency->symbol_api;
            $request = $client->request('GET', $requestUrl,[]);
            if ($request->getStatusCode() == 200){
                $data = $request->getBody()->getContents();
                $data = \GuzzleHttp\json_decode($data);
                Currency::where('id',$currency->id)->update(['conversion' => $data->data->rates->USD]);
            }
        }
    }
}
