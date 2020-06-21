<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enroll_courses', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('cources_id')->unsigned();
          $table->foreign('cources_id')->references('courses_id')->on('courses');
          $table->integer('studentId')->unsigned();
          $table->foreign('studentId')->references('studentId')->on('students');
          $table->enum('status', ['0', '1'])->default(0);
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
        Schema::dropIfExists('enroll_courses');
    }
}
