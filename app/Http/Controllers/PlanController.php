<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\TravelPlan;

class PlanController extends Controller
{
    public function detail(){ //show plan details
        return view('plans.show-plan');
    }

    public function search(Request $request){
        $all_countries = Country::all();
        if($request->country){
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

    public function apiIndex(){
        $all_plans = TravelPlan::all()->map(function ($plan) {
            return [
                'title' => $plan->title,
                'start' => $plan->start_date,
                'end'   => $plan->end_date,
                'id'    => $plan->id,
            ];
        }) ;
        return response()->json($all_plans);
    }

}
