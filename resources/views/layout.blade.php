<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Academia' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('alumnos.index') }}">Academia</a>
            <div class="navbar-nav">
                @auth
                    @if(auth()->user()->rol === 'administrador')
                        <a class="nav-link" href="{{ route('admin.panel') }}">Admin</a>
                    @elseif(auth()->user()->rol === 'profesor')
                        <a class="nav-link" href="{{ route('alumnos.index') }}">Alumnos</a>
                    @elseif(auth()->user()->rol === 'alumno')
                        <a class="nav-link" href="{{ route('alumnos.index') }}">Alumnos</a>
                    @endif
                @endauth
            </div>

            <div class="navbar-nav ms-auto">
                @auth
                    <span class="navbar-text text-white me-2">{{ auth()->user()->nombre }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">@csrf
                        <button class="btn btn-outline-light btn-sm">Salir</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>