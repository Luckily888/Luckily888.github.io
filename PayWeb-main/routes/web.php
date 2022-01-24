<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Model\Notification;

Route::get('/', function () {
    $useragent=$_SERVER['HTTP_USER_AGENT'];
    if (\Cache::has('currencySymbols')){
        $currencies = json_decode(\Cache::get('currencySymbols'));
    }else{
        $currencies = \App\Model\Currency::pluck('symbol')->toArray();
        \Cache::put('currencySymbols', json_encode($currencies));
    }
    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
        return view('landing2')->with(['phone' => true, 'currencies'=>$currencies]);

    $device = new \App\Model\Device();
    return view('landing2', compact('device', 'currencies'));
});
Route::get('blockchain-research', "LandingController@research");
Route::get('adoption-research', "LandingController@adoptionRes");
Route::get('mrd', "LandingController@mrd");
Route::get('digital-fund', "LandingController@digitalFund");
Route::get('token-sale-data', "LandingController@tokenSaleData");

Auth::routes();
Auth::routes(['verify' => true]);
Route::get('qr-code-g', function () {
    QrCode::size(500)
        ->format('png')
        ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));

    return view('qrCode');

});

Route::get('test-firebase', function(){
    $job = new \App\Jobs\SendNotiAfterTXSuccess;
    $job->handle();
});

Route::get('/home', 'Backend\HomeController@index');
Route::get('/login/shop', 'Backend\ShopController@login');
Route::get('/privacy-policy', function(){
    return view('privacy');
});

// Member Backend Route.
Route::get('/profile', 'Backend\ProfileController@index');
Route::post('/profile', 'Backend\ProfileController@changeProfile');
Route::post('/profile/password', 'Backend\ProfileController@changePassword');
Route::get('/payments', 'Backend\PaymentController@index');
Route::get('/payments/{currency}', 'Backend\PaymentController@search');
Route::post('/payments/{currency}', 'Backend\PaymentController@payment');
Route::post('/payments', 'Backend\PaymentController@payment');
Route::get('/payments-success', 'Backend\PaymentController@paymentSuccess');

Route::get('/histories', 'Backend\HistoryController@index');
Route::get('/histories/{email}/{coin_id}', 'Backend\HistoryController@getUserFromEmail');
Route::group(['namespace' => 'Backend', 'prefix' => 'transactions'], function(){
    Route::get('/','Backend\TransactionController@index');
    Route::get('/{currency}', ['as' => 'transaction.search', 'uses' => 'TransactionController@search']);
});
Route::prefix('/')->name('user.')->group(function () {
    Route::post('exchanges/erc20', 'Backend\ExchangeController@storeERC20')->name('exchanges.storeERC20');

    Route::resource('transfers', 'Backend\TransferController');
    Route::resource('exchanges', 'Backend\ExchangeController');
    Route::resource('kyc','Backend\KycController');
});
Route::get('/exchanges/convert/{currency1}/{currency2}/{amount1}','Backend\ExchangeController@convertCurrency');
Route::get('/generate', 'Backend\HomeController@generateWalletAddress');
Route::get('test-generate', 'Backend\HomeController@testGenerate');

Route::get('/notification/readed', function (){
    return Notification::where('uid',Auth::user()->id)->update(['readed' => true]);
});

Route::get('/balance','Backend\HomeController@balance');
Route::get('/wallets','Backend\HomeController@getwallets');
Route::get('/coins','Backend\TransferController@getcoins');
Route::get('/exchangecoins','Backend\ExchangeController@getcoins');

//Route for admin.
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('dashboard', 'AdminController@index')->name('dashboard');
    Route::get('login', 'Auth\AdminLoginController@login')->name('auth.login');
    Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('auth.loginAdmin');
    Route::post('logout', 'Auth\AdminLoginController@logout')->name('auth.logout');

    //feature route
    Route::resource('currencies', 'Backend\Admin\CurrencyController');
    Route::resource('members', 'Backend\Admin\MemberController');
    Route::resource('companies', 'Backend\Admin\CompanyController');
    Route::resource('kyc','Backend\Admin\KycController');
    Route::get('transactions', 'Backend\Admin\TransactionController@index')->name('transaction');
    Route::get('payments', 'Backend\Admin\PaymentController@index')->name('payment');
    Route::get('devvio', 'Backend\Admin\DevvioController@index')->name('devvio');
    Route::get('devvio/{coin_id}', 'Backend\Admin\DevvioController@show')->name('devvio.form');
    Route::post('devvio/send', 'Backend\Admin\DevvioController@send');

    Route::get('withdraws', 'Backend\Admin\WithdrawController@index')->name('withdraw.index');
    Route::post('withdraw-approve/{id}', 'Backend\Admin\WithdrawController@approve')->name('withdraw.approve');
    Route::post('withdraws-not-approve/{id}', 'Backend\Admin\WithdrawController@notApprove')->name('withdraw.not-approve');
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');