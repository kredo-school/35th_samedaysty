<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
// use App\Models\Plan;
use App\Models\TravelPlan;
use App\Models\TravelStyle;

class PlanController extends Controller
{

    public function detail($id)
    {
        $travel_plan = TravelPlan::findOrFail( $id );
        return view('plans.show-plan')->with('travel_plan', $travel_plan);
    }

    public function search(Request $request)
    {
        $all_countries = Country::all();
        if ($request->country) {
            $country = Country::find($request->country);
            $all_plans = TravelPlan::where('country_id', $request->country)->get();
        } else {
            $country = null;
            $all_plans = TravelPlan::all();
        }

        return view('plans.search-plan')->with('all_countries', $all_countries)
            ->with('country', $country)
            ->with('all_plans', $all_plans);
    }

public function apiIndex(Request $request)
{
    $query = TravelPlan::with('country');

    // if there is a selected country, plans would be narrowed down 
    if ($request->has('country') && $request->country) {
        $query->where('country_id', $request->country);
    }

    $all_plans = $query->get()->map(function ($plan) {
        return [
            'title' => $plan->title,
            'start' => $plan->start_date,
            'end' => $plan->end_date,
            'id' => $plan->id,
            'country' => $plan->country ? $plan->country->name : '',
            'country_code' => $plan->country ? $plan->country->code : '',
            'participants' => $plan->participants ?? 0,
            'max_participants' => $plan->max_participants ?? 0,
            'description' => $plan->description ?? '',
        ];
    });

    return response()->json($all_plans);
}


    //add create method
    public function create()
    {
        $travel_styles = TravelStyle::all();
        $all_countries = Country::all();
        return view('plans.create', compact('travel_styles', 'all_countries'));
    }

    // Form submission
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
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

        // Link the checked travel style 
        if ($request->has('travel_styles')) {
            $plan->travelStyles()->sync($request->travel_styles);
        }
        return redirect()->route('plan.create')->with('success', 'Plan created!');
    }

    public function edit(TravelPlan $plan)
    {
        return view('plans.edit', compact('plan'));
    }
}
