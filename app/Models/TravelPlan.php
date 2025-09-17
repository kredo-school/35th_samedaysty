<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TravelPlan extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'country_id',
        'start_date',
        'end_date',
        'description',
        'max_participants',
    ];


    /**
     * Get the country that owns the travel plan.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function travelStyles()
    {
        return $this->belongsToMany(TravelStyle::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function planStyles(){
        return $this->hasMany(PlanStyle::class);
    }

}
