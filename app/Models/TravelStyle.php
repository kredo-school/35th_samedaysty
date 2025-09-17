<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;

class TravelStyle extends Model
{
    protected $fillable = [
        'style_name',
        'icon_class',
        'description'
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
    public function getFontawesomeIconAttribute()
    {
        $map = [
            'relaxation' => 'fa-solid fa-spa text-[#F5BABB]',
            'adventure' => 'fa-solid fa-person-hiking text-[#FFC900]',
            'nature' => 'fa-solid fa-mountain text-[#239BA7]',
            'culture' => 'fa-solid fa-landmark text-[#BB6653]',
            'foodie' => 'fa-solid fa-utensils text-[#FF8040]',
            'shopping' => 'fa-solid fa-bag-shopping text-[#B9375D]',
            'fun-travel' => 'fa-solid fa-microphone text-[#00809D]',
            'rural' => 'fa-solid fa-tractor text-[#386641]',
            'luxury' => 'fa-solid fa-crown text-[#D3AF37]',
            'budget' => 'fa-solid fa-wallet text-[#A2AF9B]',
            'sustainable' => 'fa-solid fa-leaf text-[#08CB00]',
            'workation' => 'fa-solid fa-laptop-house text-[#4D2D8C]',
            'spontaneous' => 'fa-solid fa-map text-[#E43636]',
            'travel' => 'fa-solid fa-plane-departure text-[#3396D3]',
            'scenic' => 'fa-solid fa-camera-retro text-[#0D1164]',
        ];

        return $map[$this->style_name] ?? 'fa-solid fa-circle-question text-gray-400';
    }
}
