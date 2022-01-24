<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerificationFieldsForUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_code', 10)->nullable();
            $table->string('citizenship_code', 10)->nullable();
            $table->text('address')->nullable();
            $table->string('country_code', 10)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('id_code', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_code');
            $table->dropColumn('citizenship_code');
            $table->dropColumn('address');
            $table->dropColumn('country_code');
            $table->dropColumn('city');
            $table->dropColumn('zip');
            $table->dropColumn('id_code');
        });
    }
}
