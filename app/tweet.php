<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class tweet extends Model
{
    //
    use SoftDeletes;

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = array(
    	'message',
    	'photo',
    	'likes_count',
    	'posted_at'
    );

    public function profiles()
    {
    	return $this->belongsTo('App\profile');
    }

    public function comments()
    {
    	return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function likes()
    {
    	return $this->hasMany('App\Like');
    }
}
