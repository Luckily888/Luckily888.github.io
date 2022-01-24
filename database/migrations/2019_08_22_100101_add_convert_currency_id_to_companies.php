<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConvertCurrencyIdToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->integer('convert_currency_id')->unsigned()->nullable();
        });
        Schema::table('histories', function (Blueprint $table) {
            $table->integer('convert_currency_id')->unsigned()->nullable();
            $table->float('convert_amount',14,8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('convert_currency_id');
        });

        Schema::table('histories', function (Blueprint $table) {
            $table->dropColumn('convert_currency_id');
            $table->dropColumn('convert_amount');
        });
    }
}
