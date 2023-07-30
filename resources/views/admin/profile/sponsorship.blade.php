@extends('layouts.back')


@section('content')
    <section id="sponsorship-section">

        <h1 class="page-title text-center m-0">Sponsorizza te stesso nella nostra vetrina !</h1>

        <div class="card-container d-flex flex-column flex-lg-row align-items-center justify-content-center">

            <div class="card-sponsor">
                <div class="cover item-a">
                    <h2>Silver</h2>
                    <p>Compari tra gli sviluppatori <br> in evidenza per 24 ore</p>
                    <div class="card-back silver">
                        {{-- <a href="{{ url('sponsorships/payment') }}" class="submit" id="submit-button-1" data-amount="2.99" >24 Ore: €2.99</a> --}}
                        <a href="{{ route('token', ['amount' => 2.99]) }}">24 Ore: €2.99</a>
                    </div>
                </div>
            </div>

            <div class="card-sponsor">
                <div class="cover item-b">
                    <h2>Gold</h2>
                    <p>Compari tra gli sviluppatori <br> in evidenza per 72 ore</p>
                    <div class="card-back gold">
                        {{-- <a href="#" class="submit" id="submit-button-2" data-amount="5.99" data-bs-toggle="modal"
                            data-bs-target="#paymentModal">72 Ore: €5.99</a> --}}
                            <a href="{{ route('token', ['amount' => 5.99]) }}">72 Ore: €5.99</a>
                    </div>
                </div>
            </div>
            <div class="card-sponsor">
                <div class="cover item-c">
                    <h2>Platinum</h2>
                    <p>Compari tra gli sviluppatori <br> in evidenza per 144 ore</p>
                    <div class="card-back platinum">
                        {{-- <a href="#" class="submit" id="submit-button-3" data-amount="9.99" data-bs-toggle="modal" data-bs-target="#paymentModal">144 Ore: €9.99</a> --}}
                        <a href="{{ route('token', ['amount' => 9.99]) }}">144 Ore: €9.99</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Modale pagamento -->
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Inserisci i dati per il pagamento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div id="dropin-container-modal" style="display: flex;justify-content: center;align-items: center;">
                        </div>
                        <div style="display: flex;justify-content: center;align-items: center; color: white">
                            <a id="submit-button-modal" class="btn btn-sm btn-success d-none">Effettua Pagamento</a>
                        </div>
                    </div>

                </div>
            </div>
        </div> --}}

        <div class="px-5">
            @foreach ($sponsorshipsData as $elem)
                <div>{{$elem->end_date}}</div>
            @endforeach 

        </div> 
    </section>

    <script>
       
        
        // Richiamo la funzione con amount diverso in base al tasto
        // document.getElementById('submit-button-1').addEventListener('click', function() {
        //     performPayment(2.99);
        // });
        // document.getElementById('submit-button-2').addEventListener('click', function() {
        //     performPayment(5.99);
        // });
        // document.getElementById('submit-button-3').addEventListener('click', function() {
        //     performPayment(9.99);
        // });
        
    </script>
@endsection
