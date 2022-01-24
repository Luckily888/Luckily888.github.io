<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_choices', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('vote_header_id');
            $table->foreign('vote_header_id')->references('id')->on('vote_headers');

            $table->string('name', 200);
            $table->string('desc', 200)->nullable();
            $table->double('score', 8,2)->default(0);

            $table->unsignedInteger('count_user_vote')->default(0);

            // creator
            $table->unsignedInteger('user_id')->nullable();
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
        Schema::dropIfExists('vote_choices');
    }
}
