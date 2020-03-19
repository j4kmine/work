<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KotaModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="kota";
    protected $fillable = [
        'nama', 'id_negara', 'kode_pos','lang','lat'
    ];
}
