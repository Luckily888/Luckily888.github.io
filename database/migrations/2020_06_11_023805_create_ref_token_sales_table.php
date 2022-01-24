<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefTokenSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_token_sales', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name', 200);
            $table->string('image_path', 200)->nullable();
            $table->string('symbol', 10)->nullable();
            $table->string('status', 100);
            $table->string('use_raised',100);
            $table->string('start_date',100);
            $table->string('sale_price',100);
            $table->string('currency_price',100);
            $table->string('return_rate')->nullable();

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
        Schema::dropIfExists('ref_token_sales');
    }
}
