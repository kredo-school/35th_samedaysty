<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    protected $fillable = [
        'user_id',
        'travel_plan_id',
        'status',
        'joined_at',
    ];

    // joined user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // belongs to plan
    public function travelPlan()
    {
        return $this->belongsTo(TravelPlan::class);
    }
}
