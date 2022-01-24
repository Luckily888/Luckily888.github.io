<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevvioHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devvio_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid');
            $table->float('amount',14,8)->default(0);
            $table->string('reference');
            $table->string('status',15);
            $table->string('from');
            $table->string('to');
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
        Schema::dropIfExists('devvio_histories');
    }
}
