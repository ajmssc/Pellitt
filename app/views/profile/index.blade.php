@extends('layouts.default')

@section('content')
<div class="hero-unit">
    <div class="row">
        <div class="span6">
                <h1>Profile</h1>

				<h2>Welcome "{{ Auth::user()->email }}" to the protected page!</h2>
				<p>Your user ID is: {{ Auth::user()->id }}</p>

                <p>Games</p>
				@foreach (Auth::user()->games as $game)
		    		<a href="/games/{{ $game->short_name }}">{{ $game->name }}</a>            
            		<BR>
				@endforeach

                <p>Groups</p>
                @foreach (Auth::user()->groups as $group)
                    <a href="/groups/{{ $group->short_name }}">{{ $group->long_name }}</a>            
                    <BR>
                @endforeach
        </div>
    </div>
</div>

@stop