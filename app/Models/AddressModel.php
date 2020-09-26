<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="address";
    protected $fillable = [
        'id', 'id_user', 'nama', 'company', 'no_hp', 'email', 'tipe_user', 'catatan', 'created_at', 'updated_at', 'created_by', 'modified_by' , 'id_kota', 'id_negara', 'kode_pos' , 'alamat'
    ];
}
