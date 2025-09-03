<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $fillable = [
        'user1_id',
        'user2_id',
        'last_message',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    /**
     * Get the first user in the conversation
     */
    public function user1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    /**
     * Get the second user in the conversation
     */
    public function user2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    /**
     * Get all messages in the conversation
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the other user in the conversation
     */
    public function getOtherUser(int $currentUserId): User
    {
        if ($this->user1_id === $currentUserId) {
            return $this->user2;
        }
        return $this->user1;
    }

    /**
     * Check if a user is part of this conversation
     */
    public function hasUser(int $userId): bool
    {
        return $this->user1_id === $userId || $this->user2_id === $userId;
    }

    /**
     * Get or create conversation between two users
     */
    public static function getOrCreate(int $user1Id, int $user2Id): self
    {
        $conversation = self::where(function ($query) use ($user1Id, $user2Id) {
            $query->where('user1_id', $user1Id)
                ->where('user2_id', $user2Id);
        })->orWhere(function ($query) use ($user1Id, $user2Id) {
            $query->where('user1_id', $user2Id)
                ->where('user2_id', $user1Id);
        })->first();

        if (!$conversation) {
            $conversation = self::create([
                'user1_id' => min($user1Id, $user2Id),
                'user2_id' => max($user1Id, $user2Id),
            ]);
        }

        return $conversation;
    }
}
