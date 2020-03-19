<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NegaraModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="negara";
    protected $fillable = [
        'nama', 'lang', 'lat','base_harga_udara_document','harga_fcl20ft','harga_fcL40ft','harga_fcl40fthq','harga_bulk5kdwt','harga_bulk10kdwt','harga_bulk25kdwt','harga_bulk50kdwt'
    ];
}
