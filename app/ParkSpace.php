<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkSpace extends Model
{
    /**
     * Use table
     *
     * @var array
     */
    protected $table = 'park_space';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'park_name', 'park_locate',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        /*'locate_id',*/
    ];
}
