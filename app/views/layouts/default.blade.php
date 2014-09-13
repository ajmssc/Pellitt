<!doctype html>
<html>
<head>
	@include('includes.head')
	<link rel="stylesheet" type="text/css" href="/css/main.css">
    <script src="/js/main.js"></script>
    <script src="/js/move.js"></script>
</head>

<body>

	<div id="consoleButton">
        <img src="images/console-menu.png" onclick="openConsole()"/>
    </div>
    <div class="header">
        <div id="headerButtons">
            <img src="images/header-people.png" />
            <img id="sidebarButtonMessages" src="images/header-messages.png" onclick="openSidebar('Messages')"/>
            <img id="sidebarButtonEvents" src="images/header-events.png" onclick="openSidebar('Events')"/>
            <img src="images/header-questions.png" />
            <img src="images/header-notification.png" />
            <img src="images/header-search.png" />
        </div>
        <div class="user">
            
            
            @if (Auth::check())
                @if (Auth::user()->fbid > 0)
                    <img id="headerUserImg" src="http://graph.facebook.com/{{{ Auth::user()->fbid }}}/picture" class="userIcon"/>
                @endif
            	<span id="headerUserName">{{{ Auth::user()->email }}}</span>
            	<a href="/profile">Profile</a>
            	<a href="/auth/logout">Logout</a>
	        @else
	            <span id="headerUserName"></span>
            	<a href="/auth/register">Register</a>
	            <a href="/auth/login">Log in</a>
	            <a href="/auth/facebook">FB</a>
	        @endif
        </div>
        <div class="logo">PELLIT</div>
    </div>
    
    <div id="consoleContainer">
        
    </div>
    
    <div id="mainContent">
    	<BR><BR><BR>
    	content:
		@yield('content')
    </div>

<footer>
	@include('includes.footer')
</footer>


</body>
</html>