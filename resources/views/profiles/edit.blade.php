@extends('layouts.app')

@section('title')
Edit Tweet
@endsection
@section('content')
<h2>Use this form to edit a Profile.</h2>
@include('partials.errors')
<form method="post" action="{{'profiles.store' }}">
	@csrf
	<label for="username">
		<strong>name:</strong>
		<input type="text" id="username" name="username">
	</label>

	<label for="about_user">
		<strong>About Me</strong><textarea class="form-control" name="about user" id="about_user" cols="30" rows="10"></textarea>
	</label>

	<label for="picture">
		<strong>Select your profile picture</strong>
		<input type="file" name="photo" id="photo">
	</label>

<input type="submit" value="Create Profile">
</form>

@endsection
