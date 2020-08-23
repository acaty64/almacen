<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

	<title>@yield('title','default')</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	@yield('style')
</head>
<body class='body'>
	<div class='contenido'>
		@yield('content') 
	</div>
	@yield('script')
</body>
</html>