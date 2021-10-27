<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingStudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_studios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('studio_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('studio_name');
            $table->string('studio_price');
            $table->date('date');
            $table->integer('duration');
            $table->double('total');
            $table->string('status_booking')->default('Pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('studio_id')->references('id')->on('studios');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_studios');
    }
}
