<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    protected $primaryKey = 'rfid';
    protected $table = 'rfid';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rfid_data', 'rfid_user', 'rfid_fixed'
    ];
}
