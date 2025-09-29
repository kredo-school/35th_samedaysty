<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:travel_plans,id',
            'type'=> 'required|in:like,interested,join_request',
        ]);

        $plan_id = $request->input('plan_id');
        $type = $request->input('type');

        // check if there is a same user, plan, type 
        $existing = Reaction::where('user_id', auth()->id())
            ->where('plan_id', $plan_id)
            ->where('type', $type)
            ->first();
        
        if($existing){ 
            if ($type !== 'join_request'){
                $existing->delete();
                return back();
            }

            return back()->with('info','you have already sent a request');
        }

        Reaction::create([
            'user_id'=> auth()->id(),
            'plan_id'=> $plan_id,
            'type'=> $type,
            'status' => $type === 'join_request' ? 'pending' : null,
        ]);

        return back();
    }
}
