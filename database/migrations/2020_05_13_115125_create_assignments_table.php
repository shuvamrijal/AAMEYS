<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cources_id')->unsigned();
            $table->foreign('cources_id')->references('courses_id')->on('courses');
            $table->string('title');
            $table->string('content');
            $table->dateTime('due_date');
            $table->string('grade_category');
            $table->string('max_grade');
            $table->string('attachment');
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
        Schema::dropIfExists('assignments');
    }
}
