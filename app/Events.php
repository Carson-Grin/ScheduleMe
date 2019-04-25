<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    //
    protected $fillable = [
        'name', 'start_date', 'end_date', 'start_time', 'end_time', 'email'
    ];

}
