<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_logins', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('staff_id')->unsigned();
          $table->foreign('staff_id')->references('staff_id')->on('staff');
          $table->string('email')->unique();
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
        Schema::dropIfExists('staff_logins');
    }
}
