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
        $user = $id ? User::findOrFail($id) : Auth::user();
        //3 gadgets
        $gadgets = $user->gadgets()->orderBy('id')->take(3)->get();
        //follow and follower count
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();
        //follow or unfollow
        $isFollowing = Auth::check() && Auth::user()->isFollowing($user);
        return view('profile.show', compact('user', 'gadgets','followersCount','followingCount','isFollowing'));
    }

    public function edit()
    {
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
        ]);

        /*avatar has changed*/
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        /**user information update */
        $user->fill($validated);
        $request->user()->save();

        /**mail address has changed */
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    //update gadgets
    public function updateGadget(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'item1' => 'nullable|string|max:255',
            'item1_description' => 'nullable|string|max:1000',
            'item1_photo' => 'nullable|image|max:2048',
            'item2' => 'nullable|string|max:255',
            'item2_description' => 'nullable|string|max:1000',
            'item2_photo' => 'nullable|image|max:2048',
            'item3' => 'nullable|string|max:255',
            'item3_description' => 'nullable|string|max:1000',
            'item3_photo' => 'nullable|image|max:2048',
        ]);

        foreach (['item1', 'item2', 'item3'] as $index => $itemKey) {
            $gadget = $user->gadgets()->skip($index)->first();
            if (!$gadget && empty($validated[$itemKey])) continue; //skip if empty
            $data = [
                'item_name' => $validated[$itemKey] ?? $gadget->item_name ?? '',
                'memo' => $validated[$itemKey . '_description'] ?? $gadget->memo ?? '',
            ];
            if ($request->hasFile($itemKey . '_photo')) {
                if ($gadget && $gadget->photo_url) {
                    Storage::disk('public')->delete($gadget->photo_url);
                }
                $data['photo_url'] = $request->file($itemKey . '_photo')->store('gadgets', 'public');
            }
            if ($gadget) {
                $gadget->update($data);
            } else {
                $user->gadgets()->create($data);
            }
        }
        return redirect()->route('profile.show')->with('status', 'Gadgets updated successfully');
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
