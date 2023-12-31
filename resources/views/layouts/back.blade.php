<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Developer Dev</title>
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon/favicon-32x32.png') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- font google: Anton/Handjet/Josefin/Montserrat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Handjet&family=Josefin+Sans&family=Montserrat:wght@400;600&family=Space+Grotesk:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

    <!-- cdn Braintree -->
    <script src="https://js.braintreegateway.com/web/dropin/1.39.0/js/dropin.min.js"></script>

</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light shadow-sm z-3">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class=" animate-character logo">
                        &lt;My_developer/&gt;
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon">
                        <i class="fa-solid fa-bars"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        {{-- <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li> --}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a> --}}
                                    <a class="dropdown-item" href="{{ url('admin') }}">{{ __('Area Personale') }}</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Impostazioni') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="page-body">

            {{-- SIDEBAR --}}
            <div class="sidebar-container h-100 d-flex align-items-center">

                <aside id="sidebar" class="sidebar px-2">
                    {{-- bottone sidebar --}}
                    <div class="sidebar-button">
                        <i class="fa-solid fa-angles-right sidebar-toggle" id="toggle-button"
                            onclick="openSidebar()"></i>
                    </div>

                    {{-- link sidebar labels COMPUTER --}}
                    <div class="d-none d-lg-flex h-50 flex-column justify-content-around align-items-start">
                        <a class="sidebar-button" href="{{ url('admin') }}">{{ __('Profilo') }}</a>
                        <a class="sidebar-button" href="{{ url('reviews') }}">{{ __('Reviews') }}</a>
                        <a class="sidebar-button" href="{{ url('leads') }}">{{ __('Messaggi') }}</a>
                        <a class="sidebar-button" href="{{ url('sponsorships') }}">{{ __('Premium') }}</a>
                        {{-- <a class="sidebar-button" href="{{ url('profile') }}">{{ __('Impostazioni') }}</a> --}}
                    </div>

                    {{-- link sidebar icone MOBILE --}}
                    <div
                        class="d-lg-none h-75 w-100 d-flex flex-column justify-content-around align-items-center align-items-md-start sidebar-mobile">
                        <a class="sidebar-button sidebar-icon" href="{{ url('admin') }}">
                            <i class="fa-solid fa-user"></i>
                            <span class="icon-label d-none">Profilo</span>
                        </a>
                        <a class="sidebar-button sidebar-icon" href="{{ url('reviews') }}">
                            <i class="fa-solid fa-star-half-stroke"></i>
                            <span class="icon-label d-none">Recensioni</span>
                        </a>
                        <a class="sidebar-button sidebar-icon" href="{{ url('leads') }}">
                            <i class="fa-regular fa-comment"></i>
                            <span class="icon-label d-none">Messaggi</span>
                        </a>
                        <a class="sidebar-button sidebar-icon" href="{{ url('sponsorships') }}">
                            <i class="fa-solid fa-bullhorn"></i>
                            <span class="icon-label d-none">Premium</span>
                        </a>
                        {{-- <a class="sidebar-button sidebar-icon" href="{{ url('profile') }}">
                            <i class="fa-solid fa-gears"></i>
                            <span class="icon-label d-none">Impostazioni</span>
                        </a> --}}
                    </div>

                </aside>
            </div>



            <main class="">
                {{-- col-11 col-md-9 col-lg-10 --}}
                @yield('content')
            </main>

        </div>

        <script>
            const toggleBtn = document.getElementById('toggle-button');

            const sidebar = document.getElementById('sidebar');
            let iconLabels = document.querySelectorAll('.icon-label')

            function openSidebar() {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('sidebar-show');
                // console.log(iconLabels);

                iconLabels.forEach(elem => {
                    elem.classList.toggle('d-none');
                });

                if (toggleBtn.classList.contains('fa-angles-right')) {
                    toggleBtn.classList.remove('fa-angles-right');
                    toggleBtn.classList.add('fa-angles-left');
                } else {
                    toggleBtn.classList.remove('fa-angles-left');
                    toggleBtn.classList.add('fa-angles-right');
                }

            }
        </script>


    </div>
</body>

</html>
