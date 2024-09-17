<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/main.js', env('APP_ENV') !== 'local' ? true : false) }}" defer></script>

    {{-- css --}}
    {{-- <link rel="stylesheet" href="{{ asset('', env('APP_ENV') !== 'local' ? true : false) }}"> --}}
</head>
<body>
  <div id="app">
    <App />
  </div>
</body>
</html>
