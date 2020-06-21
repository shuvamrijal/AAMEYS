<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assign_id')->unsigned();
            $table->foreign('assign_id')->references('id')->on('assignments');
            $table->integer('staff_id')->unsigned();
            $table->foreign('staff_id')->references('staff_id')->on('staff');
            $table->integer('studentId')->unsigned();
            $table->foreign('studentId')->references('studentId')->on('students');
            $table->string('grade');
            $table->dateTime('gradeOn');
            $table->string('comment');
            $table->json('feedbackFile');
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
        Schema::dropIfExists('feedback');
    }
}
