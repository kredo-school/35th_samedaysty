<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * Get travel plans for this country
     * Note: TravelPlan model not yet implemented
     */
    // country has many plans
    public function travelPlans()
    {
        return $this->hasMany(TravelPlan::class);
    }


    /**
     * Get display name for the country
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }
}
