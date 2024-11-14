<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .bg-custom {
            background-color: #7B0A0A;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100"><!-- Body sebagai flex container dengan tinggi minimal 100% viewport -->
    <nav class="navbar navbar-expand-lg bg-custom">
        <div class="container">
            <!-- Container untuk logo dan profil -->
            <div class="d-flex align-items-center">
                <!-- Logo di kiri -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img/logo_FoodExplore.png') }}" alt="Logo" width="100" height="100"
                        class="d-inline-block align-text-top">
                </a>

                <!-- Logo profil hanya muncul di mobile -->
                <div class="d-lg-none ms-2">
                    <a href="#" class="text-decoration-none">
                        <img src="{{ asset('img/profile-user.png') }}" alt="Profile" width="40" height="40" class="rounded-circle">
                    </a>
                </div>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu di tengah -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item me-3">
                        <a class="nav-link fs-4 {{ Request::is('home') ? 'text-warning' : 'text-secondary' }}" aria-current="page" href="{{ url('/home') }}">Home</a>
                    </li>
                    
                    <li class="nav-item me-3">
                        <a class="nav-link fs-4 {{ Request::is('warung') ? 'text-warning' : 'text-secondary' }}" href="{{ url('/warung') }}">Warung</a>
                    </li>                    
                    
                    <li class="nav-item d-flex align-items-center">
                        <form class="d-flex" role="search" action="{{ route('warung.search') }}" method="GET">
                            <input class="form-control me-2 w-100" type="search" placeholder="Search" aria-label="Search" name="search_query">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </li>
                </ul>
            </div>

            <!-- Logo profil di kanan hanya muncul di desktop -->
            <div class="d-none d-lg-flex align-items-center me-4">
                <a href="profil" class="text-decoration-none">
                    <img src="{{ asset('img/profile-user.png') }}" alt="Profile" width="40" height="40" class="rounded-circle">
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4 flex-grow-1"> <!-- Konten utama dengan flex-grow agar mengisi ruang -->
        @yield('content')
    </div>

    <footer class="bg-custom text-white text-center py-4 mt-auto"> <!-- Footer dengan margin-top auto agar berada di bawah -->
        <div class="container">
            <p>&copy; 2024 Your Company. All rights reserved.</p>
            <div>
                <a href="#" class="text-white me-3">Privacy Policy</a>
                <a href="#" class="text-white me-3">Terms of Service</a>
                <a href="#" class="text-white">Contact Us</a>
            </div>
            <div class="mt-2">
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i> Facebook</a>
                <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i> Twitter</a>
                <a href="#" class="text-white"><i class="bi bi-instagram"></i> Instagram</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
