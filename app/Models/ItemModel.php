<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="items";
    protected $fillable = [
        'title', 'harga', 'kategori', 'is_tampil'
    ];
}
