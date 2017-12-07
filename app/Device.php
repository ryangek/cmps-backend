<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    protected $primaryKey = 'device_id';
    /**
     * Use table
     *
     * @var array
     */
    protected $table = 'device';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id', 'device_name', 'device_status', 'device_top', 'device_left', 'locate_id', 'device_ultra'
    ];
}
