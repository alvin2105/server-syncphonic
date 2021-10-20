<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id');
            $table->string('studio_name');
            $table->string('studio_desc');
            $table->integer('studio_capacity');
            $table->string('studio_price');
            $table->string('studio_img');
            $table->string('studio_available_day');
            $table->string('studio_status');
            $table->timestamps();
        });
        Schema::create('package_studio', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id');
            $table->unsignedBigInteger('studio_id');
            $table->string('studio_package_name');
            $table->string('studio_package_desc');
            $table->string('studio_package_price');
            $table->timestamps();

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
        Schema::dropIfExists('studios');
        Schema::dropIfExists('package_studio');
    }
}
