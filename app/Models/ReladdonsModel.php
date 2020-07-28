<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReladdonsModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="rel_addons";
    protected $fillable = [
        'id',
		'id_order',
		'id_item',
		'title',
		'jumlah',
		'satuan',
		'harga_satuan',
		'harga_total',
		'created_at',
		'updated_at',
		'created_by',
		'modified_by'
    ];
}
