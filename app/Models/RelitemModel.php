<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelitemModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="rel_item";
    protected $fillable = [
        'id', 
        'id_order', 
        'harga', 
        'deskripsi', 
        'panjang', 
        'lebar', 
        'tinggi', 
        'berat', 
        'created_at', 
        'updated_at', 
        'created_by', 
        'modified_by', 
        'kategori',
        'qty_barang',
        'id_package_barang'
    ];
}
