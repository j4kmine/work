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
		'nama',
		'longitude',
		'latitude',
		'kode_pos',
		'id_negara',
		'origin',
		'U_DTD_GC_50',
		'U_DTD_GC_100',
		'U_DTD_GC_350',
		'U_DTD_GC_500',
		'U_DTD_GC_1000',
		'L_DTD_GC_LCL_2',
		'L_DTD_GC_LCL_6',
		'L_DTD_GC_LCL_10',
		'L_DTD_GC_FCL_20ft',
		'L_DTD_GC_FCL_40ft',
		'U_DTP_GC_50',
		'U_DTP_GC_100',
		'U_DTP_GC_350',
		'U_DTP_GC_500',
		'U_DTP_GC_1000',
		'L_DTP_GC_LCL_2',
		'L_DTP_GC_LCL_3',
		'L_DTP_GC_LCL_4',
		'L_DTP_GC_LCL_5',
		'L_DTP_GC_LCL_6',
		'L_DTP_GC_LCL_7',
		'L_DTP_GC_LCL_8',
		'L_DTP_GC_LCL_9',
		'L_DTP_GC_LCL_10',
		'L_DTP_GC_FCL_20ft',
		'L_DTP_GC_FCL_40ft',
		'created_at',
		'updated_at',
		'created_by',
		'modified_by'
    ];
}
