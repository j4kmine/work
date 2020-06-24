<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="blog";

    protected $fillable = [
        'title', 'summary', 'body','keyword','id_image','url_youtube','slug'
    ];
}
