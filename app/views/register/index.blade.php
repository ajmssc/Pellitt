@extends('layouts.default')

@section('content')





<div class="pure-g">

        <div class="pure-u-3-24"></div>
        <div class="pure-u-11-24">
            <h1>Register</h1>
            Registration form
            @if($errors->any())
                <ul style="color:red">
                  {{ implode('', $errors->all('<li>:message</li>'))}}
                </ul>
            @endif
        </div>
        <div class="pure-u-7-24" style="padding: 1em; border: 1px solid #eee;">
            <div style="width:20em">
                        {{ Form::open(array('to' => 'auth/register')) }}

                        <p>{{ Form::label('email', 'Email') }}<br/>
                        {{ Form::email('email', isset($email)?$email:Input::old('email'), array('placeholder'=>'Email address')) }}</p>
                       
                        <p>{{ Form::label('password', 'Password') }}<br/>
                        {{ Form::password('password', array('placeholder'=>'Password')) }}</p>
                       
                        <p>{{ Form::label('password_confirmation', 'Password confirm') }}<br/>
                        {{ Form::password('password_confirmation', array('placeholder'=>'Confirm password')) }}</p>
                       
                        <p>{{ Form::submit('Submit', array('class' => 'pure-button pure-button-primary')) }}</p>
                       
                      {{ Form::close() }}
            </div>
        </div>
        <div class="pure-u-3-24"></div>

      
</div>
  
   
  

@stop
