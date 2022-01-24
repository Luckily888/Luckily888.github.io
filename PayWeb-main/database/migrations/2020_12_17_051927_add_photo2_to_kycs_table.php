<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoto2ToKycsTable extends Migration
{
    public function up()
    {
        Schema::table('kycs', function (Blueprint $table) {
            $table->text('photo2')->nullable();
            $table->string('id_name', 200)->nullable();
            $table->string('id_number', 50)->nullable();
        });
    }

    public function down()
    {
        Schema::table('kycs', function (Blueprint $table) {
            $table->dropColumn('photo2');
            $table->dropColumn('id_name');
            $table->dropColumn('id_number');
        });
    }
}
