@extends('layouts.back')


@section('content')
    <section id="sponsorship-section">

        <h1 class="page-title text-center m-0">Sponsorizza te stesso nella nostra vetrina !</h1>

        <div class="card-container d-flex flex-column flex-lg-row align-items-center justify-content-center">

            <div class="card-sponsor">
                <div class="cover item-a">
                    <h2>Silver</h2>
                    <p>Compari tra gli sviluppatori <br> in evidenza per 24 ore</p>
                    <!-- <span class="price">€2.99</span> -->
                    <div class="card-back silver">
                        <a href="#" class="submit" id="submit-button-1" data-amount="10">24 Ore: €2.99</a>
                        <!-- <a href="#" class="cart-btn"></a> -->
                    </div>
                </div>
            </div>

            <div class="card-sponsor">
                <div class="cover item-b">
                    <h2>Gold</h2>
                    <p>Compari tra gli sviluppatori <br> in evidenza per 48 ore</p>
                    <div class="card-back gold">
                        <a href="#" class="submit" id="submit-button-2" data-amount="20">48 Ore: €5.99</a>
                    </div>
                </div>
            </div>
            <div class="card-sponsor">
                <div class="cover item-c">
                    <h2>Platinum</h2>
                    <p>Compari tra gli sviluppatori <br> in evidenza per 144 ore</p>
                    <div class="card-back platinum">
                        <a href="#" class="submit" id="submit-button-3" data-amount="30">144 Ore: €9.99</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="container">
                                <div class="d-flex justify-content-center my-3 text-center">
                                    <div class="sponsor-base col-3 d-flex flex-column justify-content-center px-3 py-2 border">
                                        <div class="mb-2">Piano Base</div>
                                        <div class="mb-2">
                                            Sponsorizza la tu pagina per <b>24 ore.</b>
                                        </div>
                                        <a id="submit-button-1" class="btn btn-sm btn-success" data-amount="10">€2.99</a>
                                    </div>
                                    <div class="sponsor-medium col-3 d-flex flex-column justify-content-center px-3 py-2 border">
                                        <div class="mb-2">Piano Medium</div>
                                        <div class="mb-2">
                                            Sponsorizza la tu pagina per <b>72 ore.</b>
                                        </div>
                                        <a id="submit-button-2" class="btn btn-sm btn-success" data-amount="20">€5.99</a>
                                    </div>
                                    <div class="sponsor-base col-3 d-flex flex-column justify-content-center px-3 py-2 border">
                                        <div class="mb-2">Piano Advanced</div>
                                        <div class="mb-2">
                                            Sponsorizza la tu pagina per <b>144 ore.</b>
                                        </div>
                                        <a id="submit-button-3" class="btn btn-sm btn-success" data-amount="30">€9.99</a>
                                    </div>
                                </div> -->

        @csrf
        <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
        <div style="display: flex;justify-content: center;align-items: center; color: white">
            <a id="submit-button" class="btn btn-sm btn-success d-none">Submit payment</a>

        </div>
        </div>
    </section>
    <script>
        function performPayment(amount) {
            // seleziono bottone payment
            let button = document.querySelector('#submit-button');
            button.classList.remove('d-none');
            // creo la finestra di pagamento
            braintree.dropin.create({
                authorization: '{{ $token }}',
                container: '#dropin-container'
            }, function(createErr, instance) {
                // logica quando premo "submit payment"
                button.addEventListener('click', function() {
                    instance.requestPaymentMethod(function(err, payload) {
                        let pagamento = new XMLHttpRequest();
                        pagamento.onreadystatechange = function() {
                            if (pagamento.readyState === XMLHttpRequest.DONE) {
                                if (pagamento.status === 200) {
                                    console.log('success', payload.nonce);
                                    alert('Payment successfull!');
                                    window.location.reload();
                                } else {
                                    console.log('error', payload.nonce);
                                    alert('Payment failed');
                                    window.location.reload();
                                }
                            }
                        };

                        pagamento.open("POST", "{{ route('token') }}", true);
                        pagamento.setRequestHeader('Content-Type',
                            'application/x-www-form-urlencoded');
                        pagamento.setRequestHeader('X-CSRF-TOKEN', document.querySelector(
                            'meta[name="csrf-token"]').getAttribute('content'));
                        let data = "nonce=" + encodeURIComponent(payload.nonce) + "&amount=" +
                            amount;
                        pagamento.send(data);
                    });
                });
            });
        }

        // Richiamo la funzione con amount diverso in base al tasto
        document.getElementById('submit-button-1').addEventListener('click', function() {
            performPayment(2.99);
        });
        document.getElementById('submit-button-2').addEventListener('click', function() {
            performPayment(5.99);
        });
        document.getElementById('submit-button-3').addEventListener('click', function() {
            performPayment(9.99);
        });
    </script>
@endsection
