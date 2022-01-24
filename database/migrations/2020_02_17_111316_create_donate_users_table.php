<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donate_users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('donate_id');
            // เหรียญที่ user เลือกจ่ายสำหรับการโหวต
            $table->unsignedBigInteger('currency_id');
            // wallet ที่เลือกจ่าย ณ ตอนนั้น
            $table->unsignedBigInteger('wallet_id');
            // ref เพื่อเอาไปใช้ในตาราง histories
            $table->string('ref', 100)->nullable();
            $table->double('amount', 14,8)->default(0);
            $table->string('note', 250)->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('donate_id')->references('id')->on('donates');

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
        Schema::dropIfExists('donate_users');
    }
}
