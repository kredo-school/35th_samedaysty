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
    /*
    public function travelPlans(): HasMany
    {
        return $this->hasMany(TravelPlan::class, 'country_id');
    }
    */

    /**
     * Get display name for the country
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }
}
