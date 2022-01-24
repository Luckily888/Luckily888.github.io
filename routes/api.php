<?php

use Illuminate\Http\Request;

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::get('username-from-addr/{addr}', 'API\UserController@getUserFromAddr');
// TODO put this inside auth:api
Route::get('simple-balance', 'API\UserController@getBalance');

Route::resource('currency', 'API\CurrencyController');

Route::group(['middleware' => 'auth:api', 'namespace'=>'API'], function(){
    Route::post('details', 'UserController@details');

    Route::resource('history', 'HistoryController');
    
    Route::post('shop-payment', 'PaymentController@shopPayment');
    Route::post('user-payment', 'PaymentController@userPayment');

    Route::resource('balance', 'BalanceController');
    Route::get('users', 'UserController@index');
    Route::post('users', 'UserController@update');
    Route::get('user-contacts', 'UserController@getUserContacts');
    Route::resource('wallet', 'WalletController');

    Route::get('/exchanges/convert/{currency1}/{currency2}/{amount1}','ExchangeController@convertCurrency');

    Route::post('exchanges/erc20', 'ExchangeController@storeERC20')->name('api.exchanges.storeERC20');
    Route::resource('exchanges', 'ExchangeController');

    Route::get('votes', 'VoteController@getVoteList');
    Route::get('votes/{id}', 'VoteController@getVoteDetail');
    Route::post('votes/{id}', 'VoteController@postVoteChoice');
    // Donates
    Route::get('donates', 'DonateController@index');
    Route::get('donates/{id}', 'DonateController@show');
    Route::post('donates/{id}', 'DonateController@update');

    Route::resource('credits', 'CreditPaymentController');
    Route::get('user-credit/{credit_id}', 'CreditPaymentController@getUserCredit');
    Route::get('user-credit-history/{credit_id}', 'CreditPaymentController@getUserCreditHistory');
    Route::get('credit-type/{type_id}', 'CreditPaymentController@getCreditsByType');
    Route::get('credit/{id}', 'CreditPaymentController@getCredit');

    // KYC / AML
    Route::get('kyc', 'KycController@index');
    Route::post('kyc', 'KycController@store');

    Route::post('generate-address', 'WalletController@generateAddress');

    // Withdraw
    Route::post('outside-withdraw', 'WithdrawController@postOutsideWithdraw');
    Route::get('withdraw', 'WithdrawController@index');

    // ----------- Borrow
    Route::get('borrow-period', 'BorrowController@indexBorrowPeriod');
    Route::resource('borrow', 'BorrowController');
});
