<!DOCTYPE html>
<html>
<head>
	<title>@yield('title', env('APP_NAME'))</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<script type="text/javascript" src="/js/app.js" defer></script>
</head>
<body>
	<div id="app" class="d-flex h-screen flex-column justify-content-between">
		<header>
			@include('partials.nav')
			@include('partials.status')
		</header>

		<main class="py-4">
			@yield('content')	
		</main>
		
		<footer class="bg-white text-black-50 text-center py-3 shadow">
			{{ config('app.name') }} | Copyright @ {{ date('Y') }}
		</footer>
	</div>
</body>
</html>