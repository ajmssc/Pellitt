<!doctype html>
<html>
<head>
	@include('includes.head')
	<link rel="stylesheet" type="text/css" href="/css/login.css">
	<script src="/js/login.js"></script>
	
</head>

<body>

<div id="background" style="z-index: -5000;"></div>
@yield('content')

<footer>
	@include('includes.footer')
</footer>


</body>
</html>