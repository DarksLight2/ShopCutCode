<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>CutCode</title>
    <meta name="description" content="Видеокурс по изучению принципов программирования">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

    <meta name="msapplication-TileColor" content="#1E1F43">
    <meta name="theme-color" content="#1E1F43">

    @vite([
        'resources/css/app.css',
        'resources/sass/main.sass',
    ])

</head>
<body>

<main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
    <div class="container">

        <!-- Page heading -->
        <div class="text-center">
            <a href="index.html" class="inline-block" rel="home">
                <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/logo.svg') }}"
                     class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]" alt="CutCode">
            </a>
        </div>

        @yield('content')

    </div>
</main>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

@vite([
        'resources/js/app.js'
])
</body>
</html>