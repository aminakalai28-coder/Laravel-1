
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    >

    <title>@yield('title', 'Game Collection')</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('games.index') }}">
            Game Collection
        </a>

        <div class="navbar-nav">
            @auth
                <a class="nav-item nav-link" href="{{ route('dashboard') }}">
                    Dashboard
                </a>

                @role('admin')
                    <a class="nav-item nav-link"
                       href="{{ route('admin.permissions.index') }}">
                        Permissies
                    </a>

                    <a class="nav-item nav-link"
                       href="{{ route('admin.roles.index') }}">
                        Rollen
                    </a>

                    <a class="nav-item nav-link"
                       href="{{ route('admin.role-permissions.index') }}">
                        Permissies aan rollen
                    </a>

                    <a class="nav-item nav-link"
                       href="{{ route('admin.user-roles.index') }}">
                        Rollen aan gebruikers
                    </a>
                @endrole
            @endauth
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="display-4">@yield('title')</h1>

        @yield('content')
    </div>

</body>
</html>
