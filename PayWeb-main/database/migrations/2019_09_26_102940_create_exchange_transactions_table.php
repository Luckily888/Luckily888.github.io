<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('from_currency_id');
            $table->float('from_currency_amount',14,8);
            $table->float('from_currency_before',14,8);
            $table->float('from_currency_after',14,8);
            $table->float('from_currency_conversion',14,8)->default(1);

            $table->integer('to_currency_id');
            $table->float('to_currency_amount',14,8);
            $table->float('to_currency_before',14,8);
            $table->float('to_currency_after',14,8);
            $table->float('to_currency_conversion',14,8)->default(1);

            $table->integer('uid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_transactions');
    }
}
