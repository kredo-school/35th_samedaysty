<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    /**
     * Display the user's profile form.
     */
    public function show()
    {
        $user = Auth::user();
        $gadgets = $user->gadgets;
        return view('profile.show',compact('user','gadgets')
            // 'postsCount' => $postsCount,
            // 'followersCount' => $followersCount,
        );
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
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

    //update items
    public function updateGadget(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'item1' => ['nullable', 'string', 'max:255'],
            'item1_description' => ['nullable', 'string', 'max:300'
        ],
            'item1_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'item2' => ['nullable', 'string', 'max:255'],
            'item2_description' => ['nullable', 'string', 'max:300'],
            'item2_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'item3' => ['nullable', 'string', 'max:255'],
            'item3_description' => ['nullable', 'string', 'max:300'],
            'item3_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
        ]);

        // 
        foreach (['item1', 'item2', 'item3'] as $item => $item) {
            if ($request->hasFile("{$item}_image")) {
                if ($user->{"{$item}_image"}) {
                    Storage::disk('public')->delete($user->{"{$item}_image"});
                }
                $path = $request->file("{$item}_image")->store('avatars', 'public');
                $validated["{$item}_image"] = $path;
            }
        }

        $user->fill($validated);
        $user->save();

        return redirect()->route('profile.show')->with('status', 'profile-updated');
    }



    /**
     * Delete the user's account.
     */
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
