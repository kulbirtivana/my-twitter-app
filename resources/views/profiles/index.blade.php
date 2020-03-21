@extends('layouts.app')

@section('title')
Profiles Index
@endsection

@section('content')

@if(session()->get('success'))
<div role="alert">
	{{ session()->get('success')}}
</div>

@endif

<p>List of All Profiles</p>
@foreach($profiles as $profile)
<div class="card" style="width:30em">

<ul>
	<div class="card-body">
		<li>
			<h3>
				{{ $profile->name }}
			</h3>
			<div>
				<img class="img-responsive" src="{{ $profile->photo }}" alt="Profile picture" style="width:15%">
			</div>
			<p>
				{{ $profile->about_user}}
			</p>
		</li>
	</div>
</ul>
</div>
@endforeach
@endsection

@auth
@endauth