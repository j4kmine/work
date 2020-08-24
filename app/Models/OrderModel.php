<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="order";
    protected $fillable = [
		'id',
		'id_user',
		'kota_asal',
		'kota_tujuan',
		'id_tipe_pengiriman',
		'id_barang_kategori',
		'barang_deskripsi',
		'barang_nilai',
		'barang_jumlah',
		'barang_dimensi',
		'barang_berat',
		'pengirim_nama',
		'pengirim_negara',
		'pengirim_kodepos',
		'pengirim_kota',
		'pengirim_alamat',
		'pengirim_perusahaan',
		'pengirim_telepon',
		'pengirim_email',
		'pengirim_koleksi_intruksi',
		'penerima_nama',
		'penerima_negara',
		'penerima_kodepos',
		'penerima_kota',
		'penerima_alamat',
		'penerima_perusahaan',
		'penerima_telepon',
		'penerima_email',
		'referensi_customer',
		'layanan_tambahan',
		'total_harga',
		'total_approved',
		'status',
		'tanggal_order',
		'tanggal_kirim',
		'created_at',
		'updated_at',
		'created_by',
		'updated_by',
		'is_deleted',
		'deleted_at',
		'qty_container',
		'id_asuransi',
		'id_via_pengiriman',
		'id_jenis_pengiriman',
		'id_barang_jenis'
    ];
}
