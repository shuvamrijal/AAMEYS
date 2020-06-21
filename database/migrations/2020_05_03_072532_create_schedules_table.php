<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('courses_id')->unsigned();
          $table->foreign('courses_id')->references('courses_id')->on('courses');
          $table->integer('staff_id')->unsigned();
          $table->foreign('staff_id')->references('staff_id')->on('staff');
          $table->string('DaysOfWeek');
          $table->time('Start_time');
          $table->time('End_time');
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
        Schema::dropIfExists('schedules');
    }
}
