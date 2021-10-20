<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instruments', function (Blueprint $table) {
           
                // $table->id();
                $table->bigIncrements('id');
                $table->string('instrument_name');
                $table->string('instrument_brand');
                $table->integer('instrument_count');
                $table->string('instrument_price');
                $table->string('instrument_img');
                $table->string('instrument_status');
                $table->timestamps();
            });
        Schema::create('package_instrument', function (Blueprint $table) {
                // $table->id();
                $table->bigIncrements('id');
                $table->unsignedBigInteger('instrument_id');
                $table->string('instrument_bundling_name');
                $table->string('instrument_bundling_desc');
                $table->string('instrument_bundling_price');
                $table->timestamps();
    
                $table->foreign('instrument_id')->references('id')->on('instruments');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instruments');
        Schema::dropIfExists('package_instrument');
    }
}
