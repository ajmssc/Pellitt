@extends('layouts.default')

@section('navigation')
@parent
<li><a href="/about">Game</a></li>
@endsection
 
@section('content')

<div class="pure-g">
    <div class="pure-u-5-5">
        <h1>Games Home</h1>
        
        @foreach ($games as $game)
		    <a href='games/{{ $game->short_name }}'>{{ $game->name }}</a><BR>
		@endforeach

    </div>
</div>          
        

@endsection