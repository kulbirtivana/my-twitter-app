<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tweet;
use Auth;
use App\Profile;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::create();
        if($user)
            return view('comments.create');
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
                'message' => 'required|max:255',

        ));
            $input = $request->all();
            $input['user_id'] = auth()->user()->id;

            Comment::create($input);

            return redirect('/tweet')->with('success', 'Comment Saved');
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
        $comment = Comment::findOrFail($id);
        $tweet = tweet::findOrFail($id);
        $profileUser = profile::findOrFail($tweet->profile_id)
       //$profileUser = $profile->user()->get()[0];
        return view('comments.show', compact('comment'));
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
            $comment = Comment::findOrFail($id);

            return view('comments.edit', compact('comment'));
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
                'content' => 'required|max:255',
            ));

            Comment::whereId($id)->update($validatedData);
            return redirect('/tweet')->with('success', 'Comment updated');
        }
        return redirect('/tweet');
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
            $comment = Comment::findOrFail($id);

            $comment->delete();

            return redirect('/tweet')->with('success', 'Comment deleted');
        }
        return redirect('/tweet');
    }
}
