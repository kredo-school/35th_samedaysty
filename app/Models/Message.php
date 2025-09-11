<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'content',
    ];

    /**
     * Get the conversation this message belongs to
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * Get the sender of this message
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get formatted time for display
     */
    public function getFormattedTimeAttribute(): string
    {
        return $this->created_at->format('H:i');
    }

    /**
     * Get formatted date for display
     */
    public function getFormattedDateAttribute(): string
    {
        $now = now();
        $diffInDays = $this->created_at->diffInDays($now);

        if ($diffInDays === 0) {
            return 'Today';
        } elseif ($diffInDays === 1) {
            return 'Yesterday';
        } elseif ($diffInDays < 7) {
            return $this->created_at->format('l');
        } else {
            return $this->created_at->format('M j, Y');
        }
    }
}
