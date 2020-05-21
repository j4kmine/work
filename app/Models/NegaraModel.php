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
        'nama', 'longitude', 'created_at', 'updated_at', 'created_by', 'modified_by'
    ];
}
