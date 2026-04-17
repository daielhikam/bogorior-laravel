<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="{{ asset('assets/css/user-global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user-components.css') }}">
    @stack('styles')
</head>
<body>
    @include('layouts.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('layouts.footer')
    
    <script src="{{ asset('assets/js/config.js') }}"></script>
    @stack('scripts')
</body>
</html>