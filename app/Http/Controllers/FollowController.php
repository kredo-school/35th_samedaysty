<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // follow
    public function follow(User $user)
    {
        //Explicitly specify types using PHPDoc to remove the red underline
        /** @var \App\Models\User $me */
        $me = Auth::user();
        if (!$me->isFollowing($user)) {
            $me->following()->attach($user->id);
        }

        return response()->json([
            'success' => true,
            'action' => 'followed',
            'followers_count' => $user->followers()->count()
        ]);
    }
    //unfollow = delete
    public function unfollow(User $user)
    {
        /** @var \App\Models\User $me */
        $me = Auth::user();
        if ($me->isFollowing($user)) {
            $me->following()->detach($user->id);
        }
        return response()->json([
            'success' => true,
            'action' => 'unfollowed',
            'followers_count' => $user->followers()->count()
        ]);
    }
    //following list
    public function followingJson(User $user)
    {
        $following = $user->following()->get(['users.id', 'users.name', 'users.avatar']);
        return response()->json($following);
    }
    //follower list
    public function followersJson(User $user)
    {
        $followers = $user->followers()->get(['users.id', 'users.name', 'users.avatar']);
        return response()->json($followers);
    }
    //follow request
    public function followRequest(User $user)
    {
        $me = Auth::user();

        $existing = Follow::where('follower_id', $me->id)
            ->where('following_id', $user->id)
            ->first();

        if (!$existing) {
            Follow::create([
                'follower_id'  => $me->id,
                'following_id' => $user->id,
                'status'       => 'pending',
            ]);
        }

        return response()->json(['success' => true, 'status' => 'pending']);
    }


    // approved
    public function approveRequest($followId)
    {
        $follow = Follow::findOrFail($followId);

        if ($follow->following_id !== Auth::id()) abort(403);

        Follow::where('follower_id', $follow->follower_id)
            ->where('following_id', $follow->following_id)
            ->update(['status' => 'accepted']);

        return redirect()->route('profile.show', $follow->follower_id)
            ->with('success', 'Approve');
    }


    // reject
    public function rejectRequest($followId)
    {
        $follow = Follow::findOrFail($followId);
        if ($follow->following_id !== Auth::id()) abort(403);

        $follow->delete();

        return back()->with('success', 'declined');
    }
}
