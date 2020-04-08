<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tweet;
use App\User;
use Auth;
use App\profile;
use App\Comment;
USE App\FollowUnfollow;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $profiles = profile::query()
        ->join( 'users', 'profiles.user_id', '=', 'users.id' )
        ->get();

        $tweets = tweet::all();

        return view('profiles.index', compact('profiles', 'tweets'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if( $user = Auth::user() )
            return view('profiles.create');
        else
            return redirect('/tweet');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ($user = Auth::user())
        {
            $validatedData = $request->validate(array(
                'name' => 'required|max:25',
                'about_user' => 'max:255'
            ));
            $user = Auth::user();

            $profile = profile::where("user_id", "=", $user->id)->firstOrFail();


            $profile->user_id = $user->id;
            $profile->name = $validatedData['name'];
            $profile->about_user = $validatedData['about_user'];
            $profile->photo = 'photo';
            $profile->save();

            return redirect('/tweet')->with('success', 'Profile saved');
        }
        return redirect('/tweet');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = Auth::user();

        $profile = profile::findOrFail($id);
        $tweet = tweet::findOrFail($id);
        $tweets = tweet::query()
        ->join('profiles', 'tweets.profile_id', '=', 'profiles.id')
        ->select( 'tweets.id',
            'profiles.id as profile_ID',
            'profiles.name',
            'profiles.about_user',
            'profiles.photo as profile_picture',
            'tweets.message',
            'tweets.likes_count')
       ->orderBy('tweets.id', 'desc')
        ->get();
        return view('profiles.show', compact('profile', 'tweet', 'tweets'));
            
       // ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if ($user = Auth::user()){
            $profile = profile::findOrFail($id);

            return view('profiles.edit', compact('profile'));
        }
        return redirect('/tweet');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($user = Auth::user()){
            $validatedData = $request->validate(array(
                'name' => 'required|max:25',
                'about_user' => 'max:255',
            ));
            profile::whereId($id)->update($validatedData);
            return redirect('/tweet')->with('success', 'Profile updated');
        }return redirect('/tweet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if( $user = Auth::user()){
        $profile = profile::findOrFail($id);
    
            $profile->delete();
    
            return redirect('/tweet')->with('success', 'Profile deleted.');
        }
        return redirect('/tweet');
    } 

    public function showPost($id)
    {
        $tweets = tweet::query( )
        ->join( 'tweets', 'tweets.profile_id', '=', 'profiles.id' ) 
        ->get(); 

    }

    public function getUserByUsername($username)
    {
        return User::with('profile')->wherename($username)->firstOrFail();
    }


        public function followProfile($id)
    {
        $follow = New FollowUnfollow;
        $follow->profile_id = profile()->id;
        $follow->follower_id = $id;
        $follow->followed = 1;
        $follow->save();

        return redirect()->back();

    }

    public function UnfollowProfile($id)
    {
        $follow = FollowUnfollow::where('profile_id', profile()->id)
                    ->where('follower_id', $id)
                    ->delete();

                    return redirect()->back();
    }

    
}
