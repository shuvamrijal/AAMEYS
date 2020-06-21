<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_codes', function (Blueprint $table) {
          $table->increments('id');
            $table->integer('attendance_code');
            $table->integer('cources_id')->unsigned();
            $table->foreign('cources_id')->references('courses_id')->on('courses');
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
        Schema::dropIfExists('attendance_codes');
    }
}
