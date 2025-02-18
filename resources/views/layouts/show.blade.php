<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Publicaciones')</title>
    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Estilos generales -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('css')
</head>

<body>
    <header>
        <div class="brand-logo">
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('images/LogoJujuyGris.png') }}" alt="Logo" class="brand-image" style="max-height:80px; opacity: .8">
                <span class="brand-text font-weight-light">Actividades - Gobierno de Jujuy</span>
            </a>
        </div>
    </header>

    <main class="container my-4">
        @yield('content')
    </main>

    <footer>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('js')
    </footer>
</body>

</html>
