<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    //
    protected $fillable = [
        'event_id', 'event_name', 'start_date', 'end_date', 'user_email',
    ];

}
