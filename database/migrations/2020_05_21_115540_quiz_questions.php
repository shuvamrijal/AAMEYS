<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuizQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('quiz_questions', function (Blueprint $table) {
        $table->increments('question_id');
        $table->integer('quiz_id')->unsigned();
        $table->foreign('quiz_id')->references('quiz_id')->on('quizes');
        $table->string('option1');
        $table->string('option2');
        $table->string('option3');
        $table->string('answer');
        $table->string('question');
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
          Schema::dropIfExists('quiz_questions');
    }
}
