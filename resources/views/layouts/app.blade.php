<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SemanticNLP Classifier</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="d-flex flex-column min-vh-100">
    <div class="container-fluid no-padding flex-grow-1">
        @include('layouts.nav')
        <main class="py-1">
            @yield('content')
        </main>
    </div>
    @include('layouts.footer')
</div>

</body>
</html>
