<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * Use table
     *
     * @var array
     */
    protected $table = 'location';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'locate_name','locate_floor','locate_image'
    ];
}
