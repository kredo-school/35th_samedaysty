<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;

class PlanController extends Controller
{
    public function view(){
        return view('plans.show-plan');
    }

    public function search(){
        $all_countries = Country::all();
        return view('plans.search-plan')->with('all_countries', $all_countries);
    }
}
