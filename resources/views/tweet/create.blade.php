@extends('layouts.app')
@section('title')
Create Tweet Form
@endsection

@section('content')
<p>What's on your mind</p>

@include('partials.errors')
<form method="post" action="{{ route('tweet.store')}}">
	@csrf
	<label for ="message">
		<strong>Input a Message:</strong>
		<textarea name="message" id="message" cols="30" rows="10"></textarea>
	</label>
	<label for ="author">
		{{--<strong>Author name:</strong>
			<input type="text" name="author" id="author">
		</label>--}}
		<input type="submit" Value="Publish Tweet">
	</form>
	@endsection
