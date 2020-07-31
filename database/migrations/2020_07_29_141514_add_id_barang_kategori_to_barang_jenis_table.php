<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdBarangKategoriToBarangJenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_jenis', function (Blueprint $table) {
            $table->integer('id_barang_kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_jenis', function (Blueprint $table) {
            $table->dropColumn('id_barang_kategori');
        });
    }
}
