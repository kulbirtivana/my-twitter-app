@extends('layouts.app')

@section('title')
Tweets Index
@endsection

@section('content')
@if ( session()->get('success'))
<div role="alert">
	{{session()->get('success')}}
</div>
@endif
<p>List of Tweets:</p>
<ul>
	@foreach($tweets as $tweet)
	<li>
		<h2>{{$tweet->name }}</h2>
		<p>
			{{$tweet->message}}
		</p>
		<ul>
			<li>
				@auth
	<a href="{{route('tweet.edit', $tweet->id) }}">Edit Tweet</a>
			</li>
	<li>
	<form action="{{ route('tweet.destroy', $tweet->id)}}" method="post">
		@csrf
		@method('DELETE')
	<input type="submit" value="Delete Tweet">
	</form>
	@endauth
		</ul>
		<ul>
	<li>
<a href="{{route('tweet.show', $tweet->id)}}">Read More</a>
	</li>
</ul>
	@endforeach
</ul>

@if ( session()->get('success'))
<div role="alert">
	{{session()->get('success')}}
</div>
@endif
	
@endsection
