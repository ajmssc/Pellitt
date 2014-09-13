@extends('layouts.default')

@section('navigation')
@parent
<li><a href="/about">Platforms</a></li>
@endsection
 
@section('content')

<div class="pure-g">
    <div class="pure-u-5-5">
        <h1>Platforms Home</h1>
        
        @foreach ($platforms as $platform)
		    <a href='platforms/{{ $platform->short_name }}'>{{ $platform->long_name }}</a><BR>
		@endforeach

    </div>
</div>          
        

@endsection