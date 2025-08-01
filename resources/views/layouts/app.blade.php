<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Task App') }}</title>
    <!-- Bootstrap CSS (pastikan ini juga ada) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (untuk icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Vite Styles (jika digunakan) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(to right, #e6f4ec, #d0ede1, #c2e7d9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: #328E6E !important;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #fff !important;
            margin: 6px;
        }

        .navbar-brand:hover,
        .navbar-nav .nav-link:hover {
            color: #d4f5e9 !important;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #328E6E;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
        }

        .btn-success {
            background-color: #328E6E;
            border-color: #328E6E;
        }

        .btn-success:hover {
            background-color: #287a5c;
            border-color: #287a5c;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Task Manager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tasks.index') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tasks.create') }}">Buat Tugas</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <span class="nav-link text-white fw-semibold">Hallo {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item ">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-outline-light ms-2">Logout</button>
                            </form>
                        </li>
                    @else
                        @if (!Route::is('login'))
                            <li class="nav-item, btn-group">
                                <a class="nav-link, btn btn-outline-light" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                        @if (!Route::is('register'))
                            <li class="nav-item, btn-group ">
                                <a class="nav-link, btn btn-outline-light " href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer mt-auto">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Akhlish.khai`</p>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Stack scripts jika ada tambahan dari child views --}}
    @stack('scripts')
</body>

</html>
