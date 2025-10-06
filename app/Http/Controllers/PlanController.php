<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\TravelPlan;
use App\Models\TravelStyle;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    use AuthorizesRequests;


    public function detail($id)
    {
        $plan = TravelPlan::with(['joinRequests.user', 'planStyles.travelStyle'])->findOrFail($id);

        $all_styles = TravelStyle::all();

        $participation = $plan->participations()
            ->where('user_id', auth()->id())
            ->first();

        $status = $participation ? $participation->status : null;

        return view('plans.show')->with('plan', $plan)
            ->with('all_styles', $all_styles)
            ->with('join_requests', $plan->joinRequests)
            ->with('status', $status);
    }

    public function search(Request $request)
    {
        if ($request->country) {
            $country = Country::find($request->country);
            $all_plans = TravelPlan::where('country_id', $request->country)->get();
        } else {
            $country = null;
            $all_plans = TravelPlan::all();
        }

        return view('plans.search', compact('country', 'all_plans'));
    }

    public function apiIndex(Request $request)
    {
        $query = TravelPlan::with(['country', 'participants']);

        // if there is a selected country, plans would be narrowed down 
        if ($request->has('country') && $request->country) {
            $query->where('country_id', $request->country);
        }

        $all_plans = $query->get()->map(function ($travel_plan) {
            return [
                'title' => $travel_plan->title,
                'start' => $travel_plan->start_date,
                'end' => $travel_plan->end_date,
                'id' => $travel_plan->id,
                'country' => $travel_plan->country ? $travel_plan->country->name : '',
                'country_code' => $travel_plan->country ? $travel_plan->country->code : '',
                'participants' => $travel_plan->participants()->count(),
                'max_participants' => $travel_plan->max_participants ?? 0,
                'description' => $travel_plan->description ?? '',
            ];
        });

        return response()->json($all_plans);
    }

    //add create method
    public function create()
    {
        $travel_styles = TravelStyle::all();
        return view('plans.create', compact('travel_styles'));
    }

    // Form submission
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'country_id' => 'required|exists:countries,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'max_participants' => 'required|integer|min:1',
            'travel_styles' => 'nullable|array',
            'travel_styles.*' => 'exists:travel_styles,id',
        ]);

        // create a plan  and assign it to $plan 
        $plan = TravelPlan::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'country_id' => $request->country_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_participants' => $request->max_participants,
        ]);

        // Link the checked travel styles
        if ($request->has('travel_styles')) {
            $plan->syncTravelStyles($request->travel_styles);
        }
        return redirect()->route('plan.show', $plan->id)
            ->with('success', 'Plan created successfully!');
    }

    public function edit($id)
    {
        $plan = TravelPlan::findOrFail($id);

        $this->authorize('update', $plan);

        $travel_styles = TravelStyle::all();

        return view('plans.edit', compact('plan', 'travel_styles'));
    }

    public function update(Request $request, $id)
    {
        $plan = TravelPlan::findOrFail($id);

        $this->authorize('update', $plan);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'country_id' => 'required|exists:countries,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'max_participants' => 'required|integer|min:1',
            'travel_styles' => 'nullable|array',
            'travel_styles.*' => 'exists:travel_styles,id',
        ]);

        $plan->update([
            'title' => $request->title,
            'description' => $request->description,
            'country_id' => $request->country_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_participants' => $request->max_participants,
        ]);

        if ($request->has('travel_styles')) {
            $plan->syncTravelStyles($request->travel_styles);
        } else {
            $plan->detachTravelStyles();
        }

        return redirect()->route('plan.show', $plan->id)
            ->with('success', 'Plan updated successfully!');
    }

    public function deleteConfirm($id)
    {
        $plan = TravelPlan::findOrFail($id);

        $this->authorize('delete', $plan);

        return view('plans.delete', compact('plan'));
    }

    public function destroy($id)
    {
        $plan = TravelPlan::findOrFail($id);

        $this->authorize('delete', $plan);

        $plan->detachTravelStyles();
        $plan->delete();

        return redirect()->route('plan.search')
            ->with('success', 'Plan deleted successfully!');
    }
    public function myPlans()
    {
        $userId = auth()->id();

        // login user joined
        $joined = \App\Models\TravelPlan::whereHas('participations', function ($q) use ($userId) {
            $q->where('user_id', $userId)
                ->where('status', 'accepted');
        })->with('country')->get();

        // login user created
        $created = \App\Models\TravelPlan::where('user_id', $userId)
            ->with('country')->get();

        $plans = $joined->merge($created)->unique('id');

        return response()->json($plans->map(function ($plan) use ($userId) {
            return [
                'id' => $plan->id,
                'title' => $plan->title,
                'start' => $plan->start_date,
                'end' => $plan->end_date,
                'country' => $plan->country->name ?? '',
                'country_code' => $plan->country->code ?? '',
                'participants' => $plan->participants()->count(),
                'max_participants' => $plan->max_participants,
                'description' => $plan->description,
                'is_owner' => $plan->user_id === $userId, // 👈 これで正しく判定できる
            ];
        }));
    }
}
