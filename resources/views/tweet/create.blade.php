@extends('layouts.app')
@section('title')
	Create Tweet Form
	@endsection

	@section('content')
	<p>What's on your mind</p>

	@include('partials.errors')

	<div id="app" >
		<tweet-create-form 
			v-model="message"
			submission-url="{{ route( 'tweet.store') }}">
			@csrf
		</tweet-create-form>
	<Giphy v-on:image-clicked="imageClicked"/>
	</div>

<!-- <form method="post" action="{{ route('tweet.store')}}" enctype="multipart/form-data">
	@csrf
	<label for ="message">
		<strong>Input a Message:</strong>
		<textarea name="message" id="message" cols="30" rows="10"></textarea>
	</label>
   <label for="picture">
    <strong>Select image to upload:</strong>
    <br>
    <input type="file" name="picture" id="picture">
	</label>
	
<input type="submit" Value="Publish Tweet">
 <div class="form-group container h-100">
        <input class="btn btn-primary btn-customized align-bottom" type="submit" value="Publish Post">
    </div>

	</form> -->
	@endsection
