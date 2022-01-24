<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name', 200);
            $table->unsignedInteger('credit_type_id');
            $table->string('image_path', 200)->nullable();
            $table->text('desc')->nullable();

            // creator
            $table->unsignedInteger('user_id')->nullable();

            $table->foreign('credit_type_id')->references('id')->on('credit_types');

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
        Schema::dropIfExists('credits');
    }
}
