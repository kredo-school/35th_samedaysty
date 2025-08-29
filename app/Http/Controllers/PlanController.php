<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PlanController extends Controller
{
    public function view(){
        return view('plans.show-plan');
    }
}
