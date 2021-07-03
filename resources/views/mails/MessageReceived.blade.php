<!DOCTYPE html>
<html>
<head>
	<title>New Message Received</title>
</head>
<body>
	<h1>{{ $msg['name'] }}</h1>
	<h1>{{ $msg['email'] }}</h1>
	<h2>{{ $msg['subject'] }}</h2>
	<p>{{ $msg['message'] }}</p>
</body>
</html>