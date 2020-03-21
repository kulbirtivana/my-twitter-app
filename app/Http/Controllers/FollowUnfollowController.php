<?php

namespace App\Http\Controllers;

use App\FollowUnfollow;
use Illuminate\Http\Request;
use Auth;
use App\tweet;
use App\profile;
use App\User;
use App\Comment;

class FollowUnfollowController extends Controller
{
    //
    public function followProfile($id)
    {
    	$profile = profile::where("user_id", "=", $id)->firstOrFail();

    	$follower = New FollowUnfollow;
    	$follower->profile_id = $id;
    	$follower->follower_id = $profile->id;
    	$follower->followed = 1;
    	$follower->save();

    	return redirect('/tweet')->with('success', 'Started following');
    
    }

	public function UnfollowProfile($id)
	{
		if ($user = Auth::user())
		{
			$profile = profile::where("user_id", "=", $id)->firstOrFail();

			$follower = FollowUnfollow::where('profile_id', '=', $id )
			->where('follower_id', $profile->id)
			->delete();

			return redirect('/tweet')->with('success', 'Unfollow the profile');
		}
	}
}