@extends('layouts.default')

@section('navigation')
@parent
<li><a href="/about">Platform</a></li>
@endsection
 
@section('content')

<div class="pure-g">
    <div class="pure-u-5-5">
        <h1>{{ $platform->short_name }}</h1>
        Long Name: {{ $platform->long_name }}<BR>
        Parent Company: {{ $platform->company_name }}<BR>

        <BR><BR>
        Games for this platform
        <BR>
        @foreach ($platform->games as $game)
		    <a href="/games/{{ $game->short_name }}">{{ $game->name }}</a>
            
            <BR>
		@endforeach

    </div>
</div>          
        

@endsection