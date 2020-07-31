<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangJenisModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="barang_jenis";
    protected $fillable = [
        'id', 'id_barang_kategori', 'title', 'is_aktif', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
}
