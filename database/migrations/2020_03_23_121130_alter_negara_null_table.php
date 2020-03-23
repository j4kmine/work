<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNegaraNullTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('negara', function($table) {
            $table->string('nama')->nullable()->change();
            $table->string('lang')->nullable()->change();
            $table->string('lat')->nullable()->change();
            $table->integer('base_harga_udara_document')->nullable()->change();
            $table->integer('harga_fcl20ft')->nullable()->change();
            $table->integer('harga_fcL40ft')->nullable()->change();
            $table->integer('harga_fcl40fthq')->nullable()->change();
            $table->integer('harga_bulk5kdwt')->nullable()->change();
            $table->integer('harga_bulk10kdwt')->nullable()->change();
            $table->integer('harga_bulk25kdwt')->nullable()->change();
            $table->integer('harga_bulk50kdwt')->nullable()->change();
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
    }
}
