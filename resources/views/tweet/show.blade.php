@extends('layouts.app')

@section('title')
Show Tweet
@endsection
@section('content')
<h2>{{$profile->name}}</h2>
<p>
	{{$tweet->message}}
</p>

                    <h4>Display Comments</h4>

                    @include('tweet.comments', ['comments' => $tweet->comments, 'tweet_id' => $tweet->id])
                    
                    <h4>Add comment</h4>

                    <form method="post" action="{{ route('comments.store'   ) }}">

                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="content"></textarea>
                            <input type="hidden" name="tweet_id" value="{{ $tweet->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>

                        </form>
@endsection