<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * Use table
     *
     * @var array
     */
    protected $table = 'status';

    /**
    *
    * Fillable
    * @var array
    */
    protected $fillable = [
        'stat_motor',
        'stat_switch',
        'stat_ultra',
        'stat_device'
    ];
}
