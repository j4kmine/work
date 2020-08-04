<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FobModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="fob";
    protected $fillable = [
        'tipe_fob', 'barang_umum', 'agriculture', 'hewan_hidup', 'barang_mudah_terbakar', 'storage', 'freaight'
    ];
}
