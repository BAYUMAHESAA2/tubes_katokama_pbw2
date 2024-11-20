<nav class="navbar navbar-expand-lg" style="background-color: #7B0A0A; color: #ffffff;">
    <div class="container">
        <a class="navbar-brand custom-link" href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar Items Centered -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0"> <!-- Center the navbar items -->
                <li class="nav-item">
                    @auth
                        <a class="nav-link custom-link" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                    @else
                        <a class="nav-link custom-link" aria-current="page" href="{{ route('home') }}">Home</a>
                    @endauth
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link custom-link" href="{{ route('warung.index') }}">Warung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-link" href="#">Role</a>
                </li>
                    <li class="nav-item d-flex align-items-center">
                        <form class="d-flex" role="search" action="{{ route('warung.search') }}" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_query">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </li>
                    @endauth
                    
            </ul>

            @auth
                <ul class="d-flex navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle custom-link" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }} <br>
                            <span class="fw-lighter fs-6">{{ Auth::user()->email }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link custom-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-link" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
