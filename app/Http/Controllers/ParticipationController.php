<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'travel_plan_id' => 'required|exists:travel_plans,id',
        ]);

        $userId = auth()->id();
        $plan = \App\Models\TravelPlan::find($request->travel_plan_id);
        $requester = auth()->user();

        $participation = Participation::firstOrCreate(
            [
                'user_id' => $userId,
                'travel_plan_id' => $request->travel_plan_id,
            ],
            [
                'status' => 'pending',
            ]
        );

        // Send notification for new join request
        if ($participation->wasRecentlyCreated && $plan->user_id !== $userId) {
            \Log::info('Sending join request notification', [
                'plan_id' => $plan->id,
                'requester_id' => $userId,
                'owner_id' => $plan->user_id
            ]);

            $title = "New Join Request";
            $message = "{$requester->name} wants to join your plan: \"{$plan->title}\".";
            $data = [
                'plan_id' => $plan->id,
                'plan_title' => $plan->title,
                'requester_id' => $requester->id,
                'requester_name' => $requester->name,
                'type' => 'join_request',
            ];

            \App\Models\Notification::create([
                'user_id' => $plan->user_id,
                'type' => 'join_request',
                'title' => $title,
                'message' => $message,
                'data' => $data,
            ]);
        }

        return back()->with('success', 'Join request sent!');
    }

    public function update(Request $request, Participation $participation)
    {
        $request->validate([
            'status' => 'required|in:accepted,declined',
        ]);

        $participation->status = $request->status;

        // if it's accepted, return "joined_at"
        if ($request->status === 'accepted') {
            $participation->joined_at = now();
        } else {
            $participation->joined_at = null;
        }

        $participation->save();

        // 通知を送信
        if ($request->status === 'accepted') {
            NotificationService::sendJoinRequestAcceptedNotification($participation->user, $participation->travelPlan);
        } else {
            NotificationService::sendJoinRequestRejectedNotification($participation->user, $participation->travelPlan);
        }

        return back()->with('success', "Participation {$request->status} successfully!");
    }

    public function destroy(Participation $participation)
{
    // can delete only own one
    if ($participation->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $participation->delete();

    return back()->with('success', 'Join request cancelled.');
}

}
