<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;

class PlanController extends Controller
{
    public function detail(){ //show plan details
        return view('plans.show-plan');
    }

    public function search(Request $request){
        $all_countries = Country::all();
        if($request->country){
            $country = Country::find($request->country);
        } else {
            $country = null;
        }

        return view('plans.search-plan')->with('all_countries', $all_countries)
                                            ->with('country', $country);

    }

}
