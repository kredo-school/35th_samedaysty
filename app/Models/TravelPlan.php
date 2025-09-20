<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

    public function reactions(){
        return $this->hasMany(Reaction::class, 'plan_id');
    }

    public function isReacted(string $type = null){
        $query = $this->reactions()->where('user_id', Auth::id());
        // dd($query);
        if($type){
            $query->where('type', $type);
        }
        return $query->exists();
    }

}
