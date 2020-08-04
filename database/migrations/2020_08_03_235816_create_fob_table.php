<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('fob', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipe_fob')->nullable();
            $table->integer('barang_umum')->nullable();
            $table->integer('agriculture')->nullable();
            $table->integer('hewan_hidup')->nullable();
            $table->integer('barang_mudah_terbakar')->nullable();
            $table->integer('storage')->nullable();
            $table->integer('freaight')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        //
        Schema::dropIfExists('fob');
    }
}
