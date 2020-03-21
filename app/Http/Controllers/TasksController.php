<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tweet;
use App\profile;
use App\User;
use App\Comment;
use Auth;


class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $tweets = tweet::query()
        ->join('users', 'tweets.user_id', '=', 'users.id')->get();
        return view('tweet.index', compact('tweets'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        if($user)
            return view('tweet.create');
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
        if( $user = Auth::user())
        {
        $validatedData = $request->validate(array(
            'message' => 'required|max:255'
        ));
        $tweet = new tweet;
        $tweet->user_id = $user->id;
        $tweet->message = $validatedData['message'];

        $tweet->save();  
 
        return redirect('/tweet')->with('success', 'Tweet saved');
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
        $tweet = tweet::findOrFail($id);
        $tweetUser = $tweet->user()->get()[0];
        return view('tweet.show', compact('tweet'),
        compact('tweetUser'));
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
        if($user = Auth::user()){
            $tweet = tweet::findOrFail($id);
            return view('tweet.edit',compact('tweet'));
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
        $validatedData = $request->validate(array(
            'message' => 'required|max:255',
        ));

        tweet::whereId($id)->update($validatedData);
        return redirect('/tweet')->with('success', 'Tweet Updated');


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
        if($user = Auth::user()){
            $tweet = tweet::findOrFail($id);
            $tweet->delete();
            return redirect('/tweet')->with('success', 'Tweet deleted');
        }
        return redirect('/tweet');
    }
}
