<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('order')){ 
            Schema::create('order', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_user')->nullable();
                $table->string('kota_asal')->nullable();
                $table->string('kota_tujuan')->nullable();

                $table->string('tipe_pengiriman')->nullable();

                $table->string('barang_kategori')->nullable();
                $table->string('barang_deskripsi',1000)->nullable();
                $table->string('barang_nilai')->nullable();
                $table->string('barang_jumlah')->nullable();
                $table->string('barang_dimensi')->nullable();
                $table->string('barang_berat')->nullable();

                $table->string('pengirim_nama')->nullable();
                $table->string('pengirim_negara')->nullable();
                $table->string('pengirim_kodepos')->nullable();
                $table->string('pengirim_kota')->nullable();
                $table->string('pengirim_alamat',1000)->nullable();
                $table->string('pengirim_perusahaan')->nullable();
                $table->string('pengirim_telepon')->nullable();
                $table->string('pengirim_email')->nullable();
                $table->string('pengirim_koleksi_intruksi')->nullable();

                $table->string('penerima_nama')->nullable();
                $table->string('penerima_negara')->nullable();
                $table->string('penerima_kodepos')->nullable();
                $table->string('penerima_kota')->nullable();
                $table->string('penerima_alamat',1000)->nullable();
                $table->string('penerima_perusahaan')->nullable();
                $table->string('penerima_telepon')->nullable();
                $table->string('penerima_email')->nullable();

                $table->string('referensi_customer')->nullable();

                $table->string('layanan_tambahan')->nullable();

                $table->string('total_harga')->nullable();
                $table->string('total_approved')->nullable();

                $table->integer('status')->nullable();
                $table->dateTime('tanggal_order')->nullable();
                $table->dateTime('tanggal_kirim')->nullable();

                $table->dateTime('created_at')->nullable();
                $table->dateTime('updated_at')->nullable();
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->integer('is_deleted')->nullable();
                $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('order');
    }
}
