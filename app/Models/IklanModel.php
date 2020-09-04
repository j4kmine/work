<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IklanModel extends Model
{
    protected $table ="iklan";
    protected $fillable = [
        'nama','lokasi','id_image'
    ];
}