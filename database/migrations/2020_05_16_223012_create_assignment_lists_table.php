<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_lists', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('cources_id')->unsigned();
          $table->foreign('cources_id')->references('courses_id')->on('courses');
          $table->integer('staff_id')->unsigned();
          $table->foreign('staff_id')->references('staff_id')->on('staff');
          $table->integer('assign_id')->unsigned();
          $table->foreign('assign_id')->references('id')->on('assignments');
          $table->integer('studentId')->unsigned();
          $table->foreign('studentId')->references('studentId')->on('students');
          $table->dateTime('submittedDate');
          $table->string('submittedFile');
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
        Schema::dropIfExists('assignment_lists');
    }
}
