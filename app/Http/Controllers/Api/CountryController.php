<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    /**
     * Get all countries with their codes
     */
    public function index(): JsonResponse
    {
        $countries = Country::select('id', 'name', 'code')
            ->orderBy('name')
            ->get();

        return response()->json($countries);
    }

    /**
     * Get country by name
     */
    public function show(string $name): JsonResponse
    {
        $country = Country::where('name', $name)
            ->select('id', 'name', 'code')
            ->first();

        if (!$country) {
            return response()->json(['error' => 'Country not found'], 404);
        }

        return response()->json($country);
    }
}
