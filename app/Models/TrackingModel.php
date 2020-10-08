<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="tracking";
    protected $fillable = [
        'id_order','keterangan', 'flag', 'status', 'id_user'
    ];
}
