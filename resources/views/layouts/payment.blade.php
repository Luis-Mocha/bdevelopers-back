<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    {{-- font google: Anton/Handjet/Josefin/Montserrat/SpaceGrotesk--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Handjet&family=Josefin+Sans&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

    <!-- cdn Braintree -->
    <script src="https://js.braintreegateway.com/web/dropin/1.39.0/js/dropin.min.js"></script>

    {{-- font google: Anton/Handjet/Josefin/Montserrat/SpaceGrotesk--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Handjet&family=Josefin+Sans&family=Montserrat:wght@400;600&family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">

</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light shadow-sm z-3">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="animate-character logo">
                        &lt;My_developer/&gt;
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
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
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link border-register" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{-- <a class="dropdown-item" href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a> --}}
                                <a class="dropdown-item" href="{{ url('admin') }}">{{ __('Area Personale') }}</a>
                                <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Impostazioni') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        <main class="payment-main">
            {{-- carattersitiche diverse di ogni pagamento --}}
            @yield('content')

            @csrf
            <div id="dropin-payment" style="display: flex;justify-content: center;align-items: center;">
            </div>
            <div style="display: flex;justify-content: center;align-items: center; color: white">
                <a id="payment-button" class="btn btn-sm btn-success">Effettua Pagamento</a>
            </div>

            <div id="modalSuccess" class="modal">
                <div class="modal-content">
                    <p>Pagamento effettutato con successo!</p>
                    <button id="successBtn" class="close">Continua</button>
                </div>
            </div>

            <div id="modalFail" class="modal">
                <div class="modal-content">
                    <p>Pagamento fallito!</p>
                    <button id="failBtn" class="close">Riprova</button>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Select the payment button inside the modal
        let button = document.querySelector('#payment-button');

        const modalSuccess = document.getElementById('modalSuccess');
        const successBtn = document.getElementById('successBtn');


        const modalFail = document.getElementById('modalFail');
        const failBtn = document.getElementById('failBtn');

        successBtn.addEventListener('click', function() {
            window.location.href = "http://127.0.0.1:8000/sponsorships#recap-table"
        });

        failBtn.addEventListener('click', function() {
            modalFail.style.display = 'd-none';
        });

        // Create the Braintree Drop-in instance inside the modal
        braintree.dropin.create({
            authorization: '{{ $token }}',
            container: '#dropin-payment'
        }, function(createErr, instance) {
            // Logic when the "Submit payment" button is clicked inside the modal
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    let pagamento = new XMLHttpRequest();
                    pagamento.onreadystatechange = function() {
                        if (pagamento.readyState === XMLHttpRequest.DONE) {
                            if (pagamento.status === 200) {
                                console.log('success', payload.nonce);
                                // alert('Payment successful!');

                                modalSuccess.style.display = 'block';

                            } else {
                                console.log('error', payload.nonce);
                                // alert('Payment failed');
                                modalFail.style.display = 'block';
                            }
                        }
                    };

                    pagamento.open("POST", "{{ route('tokenSilver') }}", true);
                    pagamento.setRequestHeader('Content-Type',
                        'application/x-www-form-urlencoded');
                    pagamento.setRequestHeader('X-CSRF-TOKEN', document.querySelector(
                        'meta[name="csrf-token"]').getAttribute('content'));
                    let data = "nonce=" + encodeURIComponent(payload.nonce)
                    pagamento.send(data);
                });
            });
        });
    
    </script>

</body>

</html>