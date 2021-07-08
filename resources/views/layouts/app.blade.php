<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('template/css/app.css')}}" rel="stylesheet">
</head>
<body>
    @include('sweetalert::alert')
    @if(auth()->user())
    <div id="app" class="wrapper">
        @include('layouts.sidebar')
        @endif

        @if(auth()->user())
        <main class="main">
            @include('layouts.navbar')
            @endif
            @yield('content')
            @if(auth()->user())
        </main>
    </div>
    @endif

	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('template/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    @yield('custom-scripts')
</body>
</html>
