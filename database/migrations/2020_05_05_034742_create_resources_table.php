<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
          $table->increments('resources_id');
          $table->integer('courses_id')->unsigned();
          $table->foreign('courses_id')->references('courses_id')->on('courses');
          $table->string('Resources_Name');
          $table->string('Resources_Path');
          $table->string('Resources_Description');
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
        Schema::dropIfExists('resources');
    }
}
