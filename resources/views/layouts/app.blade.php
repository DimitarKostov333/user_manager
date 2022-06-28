<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('templates.header')
</head>
<body>
<div id="app">
    @include('navigation.menu')
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
