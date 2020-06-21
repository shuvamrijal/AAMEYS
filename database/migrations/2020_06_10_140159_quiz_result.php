<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuizResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('quiz_results', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('quiz_id')->unsigned();
          $table->foreign('quiz_id')->references('quiz_id')->on('quizes');
          $table->integer('cources_id')->unsigned();
          $table->foreign('cources_id')->references('courses_id')->on('courses');
          $table->integer('studentId')->unsigned();
          $table->foreign('studentId')->references('studentId')->on('students');
          $table->string('marks');
          $table->enum('status', ['0', '1'])->default(0);
          $table->string('comment');
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
          Schema::dropIfExists('quiz_results');
    }
}
