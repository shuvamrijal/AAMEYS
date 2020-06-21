<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_logins', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('studentId')->unsigned();
          $table->foreign('studentId')->references('studentId')->on('students');
          $table->string('username')->unique();
          $table->string('password',255);
          $table->rememberToken();
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
        Schema::dropIfExists('student_logins');
    }
}
