<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsuransiModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="asuransi";
    protected $fillable = [
        'id', 'id_jenis_barang', 'title', 'is_aktif', 'created_by', 'updated_by', 'created_at', 'updated_at', 'rate', 'harga'
    ];
}
