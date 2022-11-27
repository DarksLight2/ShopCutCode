<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title', env('APP_NAME'))</title>
    <meta name="description" content="Видеокурс по изучению принципов программирования">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="msapplication-TileColor" content="#1E1F43">
    <meta name="theme-color" content="#1E1F43">

    @vite(['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/app.js'])

</head>
<body>

@include('shared.header')

<main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
    <div class="container">

        @yield('content')

    </div>
</main>

@include('shared.footer')

</body>
</html>
