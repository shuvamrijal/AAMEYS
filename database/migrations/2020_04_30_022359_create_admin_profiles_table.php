<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()



    {
        Schema::create('admin_profiles', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('admin_id')->unsigned();
          $table->foreign('admin_id')->references('id')->on('admins');
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
          $table->boolean('status');
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
        Schema::dropIfExists('admin_profiles');
    }
}
