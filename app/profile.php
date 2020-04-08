<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class profile extends Model
{
    //
    //use CanComment;

    public $timestamps = false;

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany( 'App\Comment' );
    }

    public function tweets()
    {
        return $this->hasMany( 'App\tweet' );
    }

    public function followers()
    {
        return $this->hasMany( 'App\FollowUnfollow' )->withTimestamps();
    }

    public function followings()
    {
        return $this->hasMany( 'App\FollowUnfollow' )->withTimestamps();
    }

    public function likedPosts()
{
    return $this->morphedByMany('App\tweet', 'likes')->whereDeletedAt(null);
}

    protected $fillable = [
        'name', 'user_id', 'about_user', 'photo'
    ];
}
