<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Welcome</h2>

		<div>
			Welcome, please <a href="{{ URL::to('register/verify/' . $confirmationlink) }}">confirm your email address.</a>
		</div>
	</body>
</html>