<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagesModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="images";
    protected $fillable = [
        'title', 'description', 'path'
    ];
}
