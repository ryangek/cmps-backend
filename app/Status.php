<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $primaryKey = 'stat_id';
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
        'stat_switch',
        'stat_ultra',
        'stat_device'
    ];
}
