<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;

class TravelStyle extends Model
{
    protected $fillable = [
        'style_name',
    ];

    /**
     * Get travel plans for this style
     * Note: TravelPlan model not yet implemented
     */
    /*
    public function travelPlans(): HasMany
    {
        return $this->hasMany(TravelPlan::class, 'style_id');
    }
    */

    /**
     * Get display name for the style
     */
    public function getDisplayNameAttribute(): string
    {
        return ucfirst($this->style_name);
    }
}
