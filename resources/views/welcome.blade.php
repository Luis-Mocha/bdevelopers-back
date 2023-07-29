@extends('layouts.app')
@section('content')
    <section id="section-welcome" class="text-center">
        {{-- <div class="content  wrapper">
            <h1 class="text-center mt-5 text-uppercase">Benvenuto Developer</h1>
        <h1 class="text-center mt-5 text-uppercase">Benvenuto Developer</h1>
            <div class="content">
                <h1 class="text-center text-uppercase">Benvenuto in &lt;My_developer/&gt;</h1>
                <h1 class="text-center text-uppercase">Benvenuto in &lt;My_developer/&gt;</h1>
            </div>
        </div> --}}
        {{--Prima sezione--}}
    <div class="square first">
        <h2 class="title mt-2">Tutto in  un unica piattaforma</h2>
        <div>
            <i class="fa-solid fa-list-check" style="color: #ffffff;"></i>
            <span class="text-white">Area personale</span>
            <div class="text-white">Gestisci tutto da un unica piattaforma, anche da mobile</div>
        </div>
        <div>
            <i class="fa-solid fa-star" style="color: #ffffff;"></i>
            <span class="text-white">Recensioni</span>
            <div class="text-white">Tutte le recensioni dei tuoi clienti in tempo reale </div>
        </div>
        <div>
            <i class="fa-solid fa-inbox" style="color: #ffffff;"></i>
            <span class="text-white">Notifiche</span>
            <div class="text-white">Ricevi una notifica ad ogni nuova richiesta e visualizza tutte le informazioni del cliente.</div>
        </div>
    </div>
        {{--Seconda sezione--}}
    <div class="square second">
        <h2 class="title mt-2">Come funziona</h2>
        <div>
            <div>
                <i class="fa-solid fa-user-pen" style="color: #ffffff;"></i>
                <span class="text-white">Crea il tuo profilo</span>
                <div class="text-white">Iscriviti gratuitamente, configura il tuo profilo e offri il tuo lavoro al nostro pubblico.</div>
            </div>
            <i class="fa-solid fa-arrow-down-long" style="color: #ffffff;"></i>
            <div>
                <i class="fa-solid fa-envelope-open-text" style="color: #ffffff;"></i>
                <span class="text-white">Fai un buon lavoro</span>
                <div class="text-white">Ricevi una notifica quando ricevi un ordine e utilizza la nostra piattaforma per discutere i dettagli con i clienti.</div>
            </div>
            <i class="fa-solid fa-arrow-down-long" style="color: #ffffff;"></i>
            <div class="text-white">
                <i class="fa-solid fa-envelope-open-text" style="color: #ffffff;"></i>
                <span class="text-white">Ricevi il pagamento</span>
                <div class="text-white">Ricevi pagamenti puntuali, ogni volta.</div>
            </div>

        </div>
    </div>
    <div class="square third">
        <h2 class="title mt-2">Metti in cima alle ricerche il tuo profilo</h2>
    </div>
    <div class="square fourth">
        <h2 class="title mt-2">Da scegliere</h2>
    </div>


    </section>
@endsection
