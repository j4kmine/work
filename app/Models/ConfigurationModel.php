<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigurationModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table ="configuration";
    public $timestamps = false;
    protected $fillable = [
        'meta_title', 'site_title', 'meta_description','meta_keyword','alamat','hp','fax','email','fb','nophone','twitter','instagram','id_image','service_pricing'
        ,'local_charge','fob'
    ];
}
