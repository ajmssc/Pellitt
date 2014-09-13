@extends('layouts.default')

@section('content')





<div class="pure-g">
@if(isset($verifylink))
    <div class="pure-u-5-24"></div>
    <div class="pure-u-14-24">
    Email confirmed
        Link: {{ $verifylink }}
    </div>
    <div class="pure-u-5-24"></div>
@endif

      
</div>
  
   
  

@stop
