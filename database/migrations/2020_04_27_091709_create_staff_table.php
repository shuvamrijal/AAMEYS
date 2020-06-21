<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
          $table->increments('staff_id');
          $table->string('FirstName')->index();
          $table->string('LastName')->index();
          $table->string('street');
          $table->string('city');
          $table->string('state');
          $table->string('postcode');
            $table->string('country');
          $table->string('PhoneNo');
          $table->string('image');
          $table->string('email');
          $table->string('gender');
          $table->string('dateofbirth');
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
        Schema::dropIfExists('staff');
    }
}
