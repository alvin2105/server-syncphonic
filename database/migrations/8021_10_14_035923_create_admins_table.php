<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id');
            $table->unsignedBigInteger('studio_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('instrument_id');
            $table->unsignedBigInteger('user_id');
            $table->string('email');
            $table->string('password');
            $table->string('name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('studio_id')->references('id')->on('studios');
            $table->foreign('instrument_id')->references('id')->on('instrument');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
