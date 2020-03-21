@extends('layouts.app')

@section('title')
Edit Comment
@endsection

@section('content')


<h1> Edit your Comment Here!</h1>

@include('partials.errors')


<form method="post" action="{{ route( 'comments.update', $comment->id) }}">

<div class="form-group">

    @csrf {{-- cross site request forgery. a security mesaure --}}
    
    @method('PATCH')

    <label for="content">
        <strong> Comment content: </strong>
        <br>
        <textarea name="content" id="content" cols="30" rows="10">{{ $comment->content }}</textarea>
    </label>
    </div>

    <div class="form-group container h-80">
    <input class="btn btn-success" type="submit" value="Update your comment">
    </div>
    </form> 

    <div class="form-group container h-100">
        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                        @csrf 
                        @method('DELETE')
                        <input class="btn btn-warning" type="submit" value="Delete Comment">
    </div>

</form>

</div>
</div>

@endsection