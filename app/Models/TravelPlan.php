<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelPlan extends Model
{
    //
    protected $fillable = [
        'user_id',
        'title',
        'country_id',
        'start_date',
        'end_date',
        'description',
        'max_participants',
    ];
}
