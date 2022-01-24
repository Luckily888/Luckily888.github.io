<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_periods', function (Blueprint $table) {
            $table->unsignedInteger('id');

            $table->string('name');
            $table->integer('period_amount');
            // day, week, month, year
            $table->string('period_type');
            $table->float('interest_percentage', 14,8);

            $table->primary('id');

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
        Schema::dropIfExists('borrow_periods');
    }
}
