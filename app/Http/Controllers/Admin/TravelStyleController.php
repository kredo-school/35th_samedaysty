<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelStyle;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TravelStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $travelStyles = TravelStyle::orderBy('style_name')->paginate(10);
        return view('admin.travel-styles.index', compact('travelStyles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.travel-styles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'style_name' => 'required|string|max:255|unique:travel_styles,style_name',
        ]);

        TravelStyle::create([
            'style_name' => strtolower(trim($request->style_name)),
        ]);

        return redirect()->route('admin.travel-styles.index')
            ->with('success', 'Travel style created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TravelStyle $travelStyle): View
    {
        return view('admin.travel-styles.show', compact('travelStyle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TravelStyle $travelStyle): View
    {
        return view('admin.travel-styles.edit', compact('travelStyle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TravelStyle $travelStyle): RedirectResponse
    {
        $request->validate([
            'style_name' => 'required|string|max:255|unique:travel_styles,style_name,' . $travelStyle->id,
        ]);

        $travelStyle->update([
            'style_name' => strtolower(trim($request->style_name)),
        ]);

        return redirect()->route('admin.travel-styles.index')
            ->with('success', 'Travel style updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelStyle $travelStyle): RedirectResponse
    {
        // Check if travel style is being used
        // Note: TravelPlan model not yet implemented, so skipping this check for now
        /*
        if ($travelStyle->travelPlans()->count() > 0) {
            return redirect()->route('admin.travel-styles.index')
                ->with('error', 'Cannot delete travel style. It is being used by travel plans.');
        }
        */

        $travelStyle->delete();

        return redirect()->route('admin.travel-styles.index')
            ->with('success', 'Travel style deleted successfully.');
    }
}
