<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUnfollow extends Model
{
    //
    protected $fillable = ['profile_id', 'follower_id', 'followed'];

    protected $primarykey = 'profile_id';

    public function profiles()
    {
    	return $this->belongsTo(profile::class);
    }
}
