<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $primaryKey = 'history_id';
    protected $table = 'history';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'device', 'location'
    ];
}
