<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="users";
    protected $fillable = [
        'name', 'email', 'password','lastname','address','datebirth','membershiptype','membershifee','ccnumber','cctype','ccexpiremonth','ccexpireyear','gender'
    ];
}
