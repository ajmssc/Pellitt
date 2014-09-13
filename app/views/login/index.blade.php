@extends('layouts.login')

@section('content')

<div id="loginContainer">
    <div class="logo">PELLIT</div>
    <div id="loginBox">
        {{ Form::open(array('url' => '/auth/login', 'class' => 'pure-form')) }}
            <div id="loginForm">
                {{ Form::text('email', Input::old('email'), array('class' => 'loginInput')) }}
                {{ Form::password('password', array('class' => 'loginInput')) }}
            </div>
            <button id="loginButton"><div>Login</div></button>
        {{ Form::close() }}
    </div>
    <div id="loginPrompt">
        <span id="loginPromptEmail">Email</span><br>
        <span id="loginPromptPassword">Password</span>
    </div>
        @if (Session::has('flash_error'))
            <div id="flash_error"><font color=red>{{ Session::get('flash_error') }}</font></div>
        @endif
        @if (Session::has('flash_notice'))
            <div id="flash_notice"><font color=green>{{ Session::get('flash_notice') }}</font></div>
        @endif
</div>




<script>
    $(function() {
        initHome();
    });
</script>
@stop