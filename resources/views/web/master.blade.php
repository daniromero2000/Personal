<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <title>Módulo admin</title>
</head>

<body>
        @include('web.partials.nav-header-main')

    <div class="container" id="app">
        @yield('content')
    </div>
    <script src="{{ asset("js/app.js") }}"></script>

    @include('web.partials.footer')

</body>

</html>
