<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRelItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('rel_item')){ 
            Schema::create('rel_item', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_order');
                $table->string('harga',1000)->nullable();
                $table->string('deskripsi',1000)->nullable();
                $table->string('panjang')->nullable();
                $table->string('lebar')->nullable();
                $table->string('tinggi')->nullable();
                $table->string('berat')->nullable();
                $table->timestamps();
                $table->string('created_by')->nullable();
                $table->string('modified_by')->nullable();
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
        Schema::dropIfExists('rel_item');
    }
}
