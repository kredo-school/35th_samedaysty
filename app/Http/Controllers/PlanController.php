<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
// use App\Models\Plan;
use App\Models\TravelPlan;

class PlanController extends Controller
{
    public function detail()
    {
        return view('plans.show-plan');
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

    public function apiIndex()
    {

        $all_plans = TravelPlan::with('country')->get()->map(function ($plan) {
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
        return view('plans.create'); // ここは実際のビュー名に置き換え
    }

    // Form submission
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        TravelPlan::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('plan.create')->with('success', 'Plan created!');
    }
}
