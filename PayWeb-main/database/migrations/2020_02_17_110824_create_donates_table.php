<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donates', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name', 200);
            $table->string('image_path', 200)->nullable();
            $table->text('desc')->nullable();

            // creator
            $table->unsignedInteger('user_id')->nullable();

            $table->timestamp('start_datetime');
            $table->timestamp('end_datetime');

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
        Schema::dropIfExists('donates');
    }
}
