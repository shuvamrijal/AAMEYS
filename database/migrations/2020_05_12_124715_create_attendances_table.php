<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cources_id')->unsigned();
            $table->foreign('cources_id')->references('courses_id')->on('courses');
            $table->integer('studentId')->unsigned();
            $table->foreign('studentId')->references('studentId')->on('students');
            $table->integer('staff_id')->unsigned();
            $table->foreign('staff_id')->references('staff_id')->on('staff');
            $table->dateTime('attendance_date');
            $table->enum('status', ['0', '1'])->default(1);
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
        Schema::dropIfExists('attendances');
    }
}
