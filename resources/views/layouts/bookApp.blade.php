<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/megazine/js/jquery.min.1.7.js') }}"></script>
    <script src="{{ asset('js/megazine/js/hash.js') }}" defer></script>
    <script src="{{ asset('js/megazine/js/magazine.js') }}" defer></script>
    <script src="{{ asset('js/megazine/js/turn.js') }}" defer></script>
    <script src="{{ asset('js/megazine/js/zoom.min.js') }}" defer></script>
    <link href="{{ asset('css/magazine.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
</head>
<body class = "bg-gray-200 text-gray-800 antialiased font-sans">
    <main class="h-screen">
            @yield('book_content')
    </main>

</body>
</html>
