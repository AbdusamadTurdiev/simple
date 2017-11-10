<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="/css/app.css">
		<link rel="stylesheet" href="/css/style.css">
		<title>Simple</title>
	</head>
	<body>
		@include('templates.partials.navigation')
		<div class="container" id="app">
			@include('templates.partials.alerts')
			@yield('content')
		</div>
		<script src="/js/app.js"></script>
	</body>
</html>