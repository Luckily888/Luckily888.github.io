<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('loan_currency_id');
            $table->float('loan_amount',14,8)->default(0);
            $table->unsignedBigInteger('collateral_currency_id');
            $table->float('collateral_amount',14,8)->default(0);

            $table->unsignedBigInteger('borrow_period_id');
            $table->float('percentage',14,8)->default(0);
            $table->string('period_text')->nullable();
            $table->float('interest_amount',14,8)->default(0);
            $table->float('end_period_amount',14,8)->default(0);

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
        Schema::dropIfExists('borrows');
    }
}
