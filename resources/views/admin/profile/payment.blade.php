@extends('layouts.app')


@section('content')
    <section id="sponsorship-section">

        <h1 class="page-title text-center m-0">Completa l'acquisto</h1>

        {{-- <div>{{$amount}}</div> --}}
        @csrf
        <div id="dropin-payment" style="display: flex;justify-content: center;align-items: center;">
        </div>
        <div style="display: flex;justify-content: center;align-items: center; color: white">
            <a id="payment-button" class="btn btn-sm btn-success">Effettua Pagamento</a>
        </div>


    </section>

    <script>
        console.log();
            // Select the payment button inside the modal
            let button = document.querySelector('#payment-button');

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
                                    alert('Payment successful!');
                                    // Close the modal after successful payment
                                    // document.getElementById('paymentModal').style.display =
                                    //     'none';
                                    // window.location.reload();
                                    window.location.href = "http://127.0.0.1:8000/sponsorships";
                                } else {
                                    console.log('error', payload.nonce);
                                    alert('Payment failed');
                                    // Close the modal after payment failure
                                    // document.getElementById('paymentModal').style.display =
                                    //     'none';
                                    // window.location.reload();
                                }
                            }
                        };

                        pagamento.open("POST", "{{ route('token') }}", true);
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
@endsection