<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    /** Display the user's profile form */
    public function show($id = null)
    {
        //if don't give ID
        /** @var \App\Models\User $user */
        $user = $id ? User::findOrFail($id) : Auth::user();
        //3 gadgets
        $gadgets = $user->gadgets()->orderBy('id')->take(3)->get();
        $postsCount = $user->travelPlans()->count();
        //follow and follower count
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();
        //follow or unfollow
        /** @var \App\Models\User $me */
        $me = Auth::user();
        $isFollowing = $me ? $me->isFollowing($user) : false;
        //get conversation
        // $conversation = $user->conversations->latest()->first();

        //travel plan made by logged-in users
        $travelPlans = $user->travelPlans()->with('country')->latest()->get();
        // get interested plan 
        $interestedPlans = $user->interestedPlans()
            ->orderBy('travel_plans.created_at', 'desc')
            ->get();
        $latestInterestedPlans = $interestedPlans->take(2);
        $remainingInterestedPlans = $interestedPlans->skip(2)->values();

        //get liked plan
        $likedPlans = $user->likedPlans()
            ->orderBy('travel_plans.created_at', 'desc')
            ->get();

        $latestLikedPlans = $likedPlans->take(2);
        $remainingLikedPlans = $likedPlans->skip(2)->values();

        $allJoined = $user->joinedPlans()->with('country')->latest()->get();
        $joinedPlan = $allJoined->take(2);
        $remainingJoinedPlans = $allJoined->skip(2)->values();

        $defaults = [
            'images/bareta-1.png',
            'images/bareta-2.png',
            'images/bareta-3.png',
        ];

        foreach ($gadgets as $gadget) {
            if (empty($gadget->photo_url)) {
                $gadget->photo_url = $defaults[array_rand($defaults)];
            }
        }

        return view('profile.show', compact(
            'user',
            'gadgets',
            'followersCount',
            'postsCount',
            'followingCount',
            'isFollowing',
            'travelPlans',
            'interestedPlans',
            'latestInterestedPlans',
            'remainingInterestedPlans',
            'likedPlans',
            'latestLikedPlans',
            'remainingLikedPlans',
            'joinedPlan',
            'remainingJoinedPlans'
        ));
    }

    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $gadgets = $user->gadgets()->orderBy('id')->take(3)->get();

        $item1 = $gadgets->get(0);
        $item2 = $gadgets->get(1);
        $item3 = $gadgets->get(2);

        return view('profile.edit', compact('user', 'item1', 'item2', 'item3'));
    }

    /** Update the user's profile information. */
    public function update(Request $request)
    {
        $user = $request->user();

        /*$request->user()->fill($request->validated());*/
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'bio' => ['nullable', 'string', 'max:500'],
        ]);

        /*avatar has changed*/
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $type = $file->extension();
            $data = base64_encode(file_get_contents($file));

            $validated['avatar'] = "data:image/{$type};base64,{$data}";
        }
        /**user information update */
        $user->fill($validated);
        $user->save();
        /**mail address has changed */
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->save();
        }
        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    //update gadgets
    public function updateGadget(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'item1' => 'nullable|string|max:255',
            'item1_description' => 'nullable|string|max:500',
            'item1_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'item1_url' => 'nullable|url|max:255',
            'item2' => 'nullable|string|max:255',
            'item2_description' => 'nullable|string|max:500',
            'item2_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'item2_url' => 'nullable|url|max:255',
            'item3' => 'nullable|string|max:255',
            'item3_description' => 'nullable|string|max:500',
            'item3_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'item3_url' => 'nullable|url|max:255'
        ]);

        foreach (['item1', 'item2', 'item3'] as $index => $itemKey) {
            $gadget = $user->gadgets()->skip($index)->first();
            if (!$gadget && empty($validated[$itemKey]))
                continue; //skip if empty
            $data = [
                'item_name' => $validated[$itemKey] ?? $gadget->item_name ?? '',
                'memo' => $validated[$itemKey . '_description'] ?? $gadget->memo ?? '',
                'shop_url' => $validated[$itemKey . '_url'] ?? $gadget->shop_url ?? '',
            ];
            if ($request->hasFile($itemKey . '_photo')) {
                $file = $request->file($itemKey . '_photo');
                $type = $file->extension(); // jpg / png / gif
                $data64 = base64_encode(file_get_contents($file));
                $data['photo_url'] = "data:image/{$type};base64,{$data64}";
            }
            if ($gadget) {
                $gadget->update($data);
            } else {
                $user->gadgets()->create($data);
            }
        }
        return redirect()->route('profile.show')->with('status', 'Gadgets updated successfully');
    }
    /** Delete gadgets.*/
    public function destroyGadget($id)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $gadget = $user->gadgets()->findOrFail($id);
        $gadget->delete();

        return redirect()->route('profile.edit')
            ->with('status', 'Gadget deleted successfully');
    }


    /** Delete the user's account.*/
    public function toggleStatus()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        // switch public ⇔ private
        $user->status = $user->status === 'public' ? 'private' : 'public';
        $user->save();

        return redirect()->back()->with('success', 'Your profile is now ' . $user->status);
    }
    /** Delete the user's account.*/
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
