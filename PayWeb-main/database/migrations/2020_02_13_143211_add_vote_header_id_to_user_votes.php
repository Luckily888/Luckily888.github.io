<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVoteHeaderIdToUserVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_votes', function (Blueprint $table) {
            $table->unsignedBigInteger('vote_header_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_votes', function (Blueprint $table) {
            $table->dropColumn('vote_header_id');
        });
    }
}
