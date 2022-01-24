<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('credit_id');
            $table->float('balance',14,8)->default(0);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('credit_id')->references('id')->on('credits');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE histories MODIFY COLUMN method ENUM('payment', 'transfer', 'credit-payment')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_users');
    }
}
