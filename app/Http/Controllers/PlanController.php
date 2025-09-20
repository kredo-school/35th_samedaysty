<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\TravelPlan;
use App\Models\TravelStyle;

class PlanController extends Controller
{

    public function detail($id)
    {
        $travel_plan = TravelPlan::findOrFail($id);
        $all_styles = TravelStyle::all();
        return view('plans.show')->with('travel_plan', $travel_plan)
            ->with('all_styles', $all_styles);
    }

    public function search(Request $request)
    {
        $all_countries = Country::all();
        $grouped_countries = Country::getGroupedByRegion();

        if ($request->country) {
            $country = Country::find($request->country);
            $all_plans = TravelPlan::where('country_id', $request->country)->get();
        } else {
            $country = null;
            $all_plans = TravelPlan::all();
        }

        return view('plans.search')
            ->with('all_countries', $all_countries)
            ->with('grouped_countries', $grouped_countries)
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

        $all_plans = $query->get()->map(function ($travel_plan) {
            return [
                'title' => $travel_plan->title,
                'start' => $travel_plan->start_date,
                'end' => $travel_plan->end_date,
                'id' => $travel_plan->id,
                'country' => $travel_plan->country ? $travel_plan->country->name : '',
                'country_code' => $travel_plan->country ? $travel_plan->country->code : '',
                'participants' => $travel_plan->participants ?? 0,
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
        $travel_plan = TravelPlan::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'country_id' => $request->country_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_participants' => $request->max_participants,
        ]);

        if ($request->travel_styles) {
            $travel_plan->travelStyles()->sync($request->travel_styles);
        }

        // Link the checked travel style 
        if ($request->has('travel_styles')) {
            $travel_plan->travelStyles()->sync($request->travel_styles);
        }
        return redirect()->route('plan.create')->with('success', 'Plan created!');
    }

    public function edit(TravelPlan $travel_plan, $id)
    {
        $travel_styles = TravelStyle::all();
        $countries = Country::all();
        $travel_plan = TravelPlan::findOrFail($id);

        return view('plans.edit', compact('travel_plan', 'travel_styles', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $travel_plan = TravelPlan::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'country_id' => 'required|exists:countries,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'max_participants' => 'nullable|integer|min:1',
            'travel_styles' => 'nullable|array',
            'travel_styles.*' => 'exists:travel_styles,id',
        ]);

        $travel_plan->update([
            'title' => $request->title,
            'description' => $request->description,
            'country_id' => $request->country_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_participants' => $request->max_participants,
        ]);

        if ($request->has('travel_styles')) {
            $travel_plan->travelStyles()->sync($request->travel_styles);
        } else {
            $travel_plan->travelStyles()->detach();
        }

        return redirect()->route('plan.edit', $travel_plan->id)
            ->with('success', 'Plan updated successfully!');
    }
    public function destroy($id)
    {
        $travel_plan = TravelPlan::findOrFail($id);

        $travel_plan->travelStyles()->detach();

        $travel_plan->delete();

        return redirect()->route('plan.search')
            ->with('success', 'Plan deleted successfully!');
    }
}
