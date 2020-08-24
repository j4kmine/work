<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->integer('id_via_pengiriman')->nullable();
            $table->integer('id_jenis_pengiriman')->nullable();
            $table->integer('id_barang_jenis')->nullable();
            $table->renameColumn('tipe_pengiriman', 'id_tipe_pengiriman');
            $table->renameColumn('barang_kategori', 'id_barang_kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('id_via_pengiriman');
            $table->dropColumn('id_jenis_pengiriman');
            $table->dropColumn('id_barang_jenis');
        });
    }
}
