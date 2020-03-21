@extends('layouts.app')


@section('title')
View Profile
@endsection

@section('content')

<div class="container">
<div class="row">
<div class="col-lg-3 col-sm-6">
 <div class="card hovercard">
        <div class="cardheader"></div>


        <div><img class="avatar" class="img-fluid" src="{{$profile->photo}}" class="twPc-avatarImg" style="width:30%"/></div>

<div class="info">
    <div class="title"><h2>{{ $profile->name }} </h2>
@include('partials.errors')

<br>

	
<br>
<a href="{{ route('profile.follow', $profile->id)}}">Follow Profile</a>
<br>
 <a href="{{ route('profile.unfollow', $profile->id ) }}">Unfollow Profile</a>


	<div class="desc"><p>{{ $profile->about_user}}</p></div>
	<strong>Tweets</strong>

	{{--@foreach($tweets as $tweet)
	<strong>{{ $tweet->name}}</strong>
	<p>{{ $tweet->content}}</p>
	@endforeach--}}
</div>
</div>
</div>
</div>
@endsection