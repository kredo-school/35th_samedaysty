<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'travel_plan_id' => 'required|exists:travel_plans,id',
        ]);

        $userId = auth()->id();

        Participation::firstOrCreate(
            [
                'user_id' => $userId,
                'travel_plan_id' => $request->travel_plan_id,
            ],
            [
                'status' => 'pending',
            ]
        );

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

        return back()->with('success', "Participation {$request->status} successfully!");
    }
}
