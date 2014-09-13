@extends('layouts.default')

@section('navigation')
@parent
<li><a href="/about">Group</a></li>
@endsection
 
@section('content')

<div class="pure-g">
    <div class="pure-u-5-5">
        <h1>Groups Home</h1>
        
        @foreach ($groups as $group)
		    <a href='groups/{{ $group->short_name }}'>{{ $group->short_name }}</a><BR>
		@endforeach

    </div>
</div>          
        

@endsection