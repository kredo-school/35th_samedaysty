<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
}
