<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gadget extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'photo_url',
        'item_name',
        'memo',
        'shop_url',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


