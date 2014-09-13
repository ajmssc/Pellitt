@extends('layouts.default')

@section('navigation')
@parent
<li><a href="/about">Game</a></li>
@endsection
 
@section('content')


<div class="pure-g">
    <div class="pure-u-5-5">
        <h1>{{ $game->name }}</h1>
        Genre: {{ $game->genre }}<BR>
        Publisher: {{ $game->publisher }}<BR>
        Studio: {{ $game->studio }}<BR>
        Release date: {{ $game->release_date }}<BR><BR>

        @foreach ($game->platforms as $platform)
		    {{ $platform->short_name }}
            {{ $platform->long_name }}
            <BR>
		@endforeach

    </div>
</div>          
        

@endsection