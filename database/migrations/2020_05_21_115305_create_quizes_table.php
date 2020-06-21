<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizes', function (Blueprint $table) {
          $table->increments('quiz_id');
          $table->integer('cources_id')->unsigned();
          $table->foreign('cources_id')->references('courses_id')->on('courses');
          $table->integer('no_of_question');
          $table->string('Quiz_title');
          $table->enum('status', ['0', '1'])->default(0);
          $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizes');
    }
}
