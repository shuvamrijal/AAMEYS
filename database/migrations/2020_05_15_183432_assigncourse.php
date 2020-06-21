<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Assigncourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('assigncourses', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('cources_id')->unsigned();
          $table->foreign('cources_id')->references('courses_id')->on('courses');
          $table->integer('staff_id')->unsigned();
          $table->foreign('staff_id')->references('staff_id')->on('staff');
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
        Schema::dropIfExists('assigncourses');
    }
}
