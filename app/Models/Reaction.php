<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'type',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(TravelPlan::class);
    }

    public function scopeJoinRequests($query)
    {
        return $query->where('type', 'join_request');
    }

    public function scopeWhereType($query, $type)
    {
        return $query->where('type', $type);
    }

}
