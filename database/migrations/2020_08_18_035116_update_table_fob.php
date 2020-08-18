<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableFob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('fob', function (Blueprint $table) {
            $table->integer('storage_agriculture')->nullable();
            $table->integer('storage_hewan_hidup')->nullable();
            $table->integer('storage_barang_mudah_terbakar')->nullable();
            $table->integer('freaight_agriculture')->nullable();
            $table->integer('freaight_hewan_hidup')->nullable();
            $table->integer('freaight_barang_mudah_terbakar')->nullable();
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
        Schema::table('fob', function (Blueprint $table) {
            $table->dropColumn('storage_agriculture');
            $table->dropColumn('storage_hewan_hidup');
            $table->dropColumn('storage_barang_mudah_terbakar');
            $table->dropColumn('freaight_agriculture');
            $table->dropColumn('freaight_hewan_hidup');
            $table->dropColumn('freaight_barang_mudah_terbakar');
        });
    }
}
