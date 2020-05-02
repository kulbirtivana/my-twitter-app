<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function actOnTweet($Request, $id)
    {
    	$action = $request->get('action');
    	switch( $action ){
    		case 'Like':
    		tweet::where('id', $id)->increment('likes_count');
    		break;
    		case 'Unlike':
    		tweet::where('id', $id)->decrement('likes_count');
    		break;
    	}
    	event(new TweetAction($id, $action))
        ->toOthers();
    	return '';
    }
}
