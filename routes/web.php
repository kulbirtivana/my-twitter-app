<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::post('/tweet/{id}/act', 'LikeController@actOnTweet');

Route::get('profile/{profileId}/follow', 'FollowUnfollowController@followProfile')->name('profile.follow');

Route::get('/{profileId}/unfollow', 'FollowUnfollowController@unfollowProfile')->name('profile.unfollow');


Route::get('profile/{id}', 'ProfilesController@showPost');

// Route::get('tweet/{id}', 'TasksController@showProfile');

Route::get('comment/like/{id}', ['as' => 'comment.like', 'uses' => 'LikeController@likeComment']);

Route::get('tweet/like/{id}', ['as' => 'tweet.like', 'uses' => 'LikeController@likePost']);


Route::get('tweets/{tweet}/profiles/{profile}/comments/{comment}', function ($tweetId, $profileId, $commentId) {} );

Route::resource('tweet', 'TasksController');
Route::resource('profiles', 'ProfilesController');
Route::resource('comments', 'CommentController');

