<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanStyle extends Model
{
    protected $table = "plan_style";
    public $timestamps = false;
    protected $fillable = ['plan_id', 'style_id'];
    public function travel_style(){
        return $this->belongsTo(TravelStyle::class);
    }
}
