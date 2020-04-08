<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable =['profile_id', 'tweet_id', 'parent_id', 'message'];

    public function profiles()
    {
    	return $this->belongsTo('App\Profile');
    }

    public function tweets()
    {
    	return $this->belongsTo('App\Tweet');
    }

    public function replies()
    {
    	return $this->hasMany(Comment::class, 'parent_id');
    }
      public function likes()
    {
        return $this->hasMany('App\Like');
    }

}
