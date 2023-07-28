@extends('layouts.back')


@section('content')

<h1 class="page-title">Metti in evidenza il tuo profilo!</h1>

<div class="container">
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
    </div>

    @csrf
    <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
    <div style="display: flex;justify-content: center;align-items: center; color: white">
        <a id="submit-button" class="btn btn-sm btn-success d-none">Submit payment</a>

    </div>
</div>
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
                            } else {
                                console.log('error', payload.nonce);
                                alert('Payment failed');
                            }
                        }
                    };

                    pagamento.open("POST", "{{ route('token') }}", true);
                    pagamento.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    pagamento.setRequestHeader('X-CSRF-TOKEN', document.querySelector(
                        'meta[name="csrf-token"]').getAttribute('content'));
                    let data = "nonce=" + encodeURIComponent(payload.nonce) + "&amount=" + amount;
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