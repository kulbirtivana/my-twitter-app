@extends('layouts.app')

@section('title')
Twitter
@endsection

@section('content')
@if ( session()->get('success'))
<div role="alert">
	{{session()->get('success')}}
</div>
@endif


@section('js')
    <script>
        var updatePostStats = {
            Like: function (tweetId) {
                document.querySelector('#likes-count-' + tweetId).textContent++;
            },
            Unlike: function(tweetId) {
                document.querySelector('#likes-count-' + tweetId).textContent--;
            }
        };
        var toggleButtonText = {
            Like: function(button) {
                button.textContent = "Unlike";
            },
            Unlike: function(button) {
                button.textContent = "Like";
            }
        };
        var actOnTweet = function (event) {
            var tweetId = event.target.dataset.tweetId;
            var action = event.target.textContent;
            toggleButtonText[action](event.target);
            updatePostStats[action](tweetId);
            axios.post('/tweet' + tweetId + '/act',
                { action: action });
        };
        Echo.channel('post-events')
        .listen('TweetAction', function (event) {
            console.log(event);
            var action = event.action;
            updatePostStats[action](event.tweetId);
        })
    </script>
    @endsection

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">List of Tweets</div>
                <div class="card-body">

<ul>
	@foreach($tweets as $tweet)

	<li>
		<h2>{{$tweet->name }}</h2>
                  
		    <p>
                @if($tweet->is_gif == TRUE )
                <img src="{{ $tweet->message }}">
                @else
                {{ $tweet->message }}
                @endif
                
		    </p>
			<div class="float-none">
                    @if($follower ?? '') 
                    <small>Unfollow</small>

                    @else 
                    <small>Follow</small>

                    @endif
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

	 <div class="float-right">
                    <button  onclick="actOnTweet(event);" data-post-id="{{ $tweet->id }}">Like</button>
                    <span id="likes-count-{{ $tweet->id }}">{{ $tweet->likes_count }}</span>
                </div>
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
