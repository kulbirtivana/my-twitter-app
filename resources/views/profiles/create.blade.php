@extends('layouts.app')

@section('title')
Create your Profile here
@endsection

@section('content')

<h2> Fill out the following form to create a profile</h2>
@include('partials.errors')
<form method="get" action="{{'profiles.store' }}">
	@csrf
	<label for="username">
		<strong>Name:</strong>
		<input type="text" id="username" name="username">
	</label>
<br>
	<label for="about_user">
		<strong>About Me</strong><textarea class="form-control" name="about user" id="about_user" cols="30" rows="10"></textarea>
	</label>
<br>
	<label for="picture">
		<strong>Select your profile picture</strong>
		<input type="file" name="photo" id="photo">
	</label>
<br>
<input type="submit" value="Create Profile">
</form>

@endsection
