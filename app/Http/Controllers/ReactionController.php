<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'plan_id' => 'required|exists:travel_plans,id',
        'type' => 'required|in:like,interested,join_request',
    ]);

    $plan_id = $request->input('plan_id');
    $type = $request->input('type');

    $existing = Reaction::where('user_id', auth()->id())
        ->where('plan_id', $plan_id)
        ->where('type', $type)
        ->first();

    if ($existing) {
        if ($type !== 'join_request') {
            $existing->delete();

            $plan = \App\Models\TravelPlan::withCount([
                'reactions as like_count' => fn($q) => $q->where('type', 'like'),
                'reactions as interested_count' => fn($q) => $q->where('type', 'interested'),
            ])->find($plan_id);

            return response()->json([
                'status' => 'removed',
                'type' => $type,
                'like_count' => $plan->like_count,
                'interested_count' => $plan->interested_count,
            ]);
        }

        return response()->json([
            'status'=> 'exists',
            'message'=> 'you have already sent a request',
        ], 200);
    }

    $reaction = Reaction::create([
        'user_id' => auth()->id(),
        'plan_id' => $plan_id,
        'type' => $type,
        'status' => $type === 'join_request' ? 'pending' : null,
    ]);

    $reaction->load(['user', 'plan.user']);

    switch ($type) {
        case 'like':
            NotificationService::sendPlanLikedNotification($reaction);
            break;
        case 'interested':
            NotificationService::sendPlanInterestedNotification($reaction);
            break;
        case 'join_request':
            NotificationService::sendJoinRequestNotification($reaction);
            break;
    }

    $plan = \App\Models\TravelPlan::withCount([
        'reactions as like_count' => fn($q) => $q->where('type', 'like'),
        'reactions as interested_count' => fn($q) => $q->where('type', 'interested'),
    ])->find($plan_id);

    return response()->json([
        'status' => 'added',
        'type' => $type,
        'like_count' => $plan->like_count,
        'interested_count' => $plan->interested_count,
    ]);
}
}
