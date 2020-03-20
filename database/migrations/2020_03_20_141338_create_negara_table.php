<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('negara')){ 
            Schema::create('negara', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama');
                $table->string('lang');
                $table->string('lat');
                $table->integer('base_harga_udara_document');
                $table->integer('harga_fcl20ft');
                $table->integer('harga_fcL40ft');
                $table->integer('harga_fcl40fthq');
                $table->integer('harga_bulk5kdwt');
                $table->integer('harga_bulk10kdwt');
                $table->integer('harga_bulk25kdwt');
                $table->integer('harga_bulk50kdwt');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negara');
    }
}
