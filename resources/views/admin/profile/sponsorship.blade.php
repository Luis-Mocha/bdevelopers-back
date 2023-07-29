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
                        <a href="#" class="submit" id="submit-button-1" data-amount="2.99" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">24 Ore: €2.99</a>
                        <!-- <a href="#" class="cart-btn"></a> -->
                    </div>
                </div>
            </div>

            <div class="card-sponsor">
                <div class="cover item-b">
                    <h2>Gold</h2>
                    <p>Compari tra gli sviluppatori <br> in evidenza per 48 ore</p>
                    <div class="card-back gold">
                        <a href="#" class="submit" id="submit-button-2" data-amount="5.99" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">48 Ore: €5.99</a>
                    </div>
                </div>
            </div>
            <div class="card-sponsor">
                <div class="cover item-c">
                    <h2>Platinum</h2>
                    <p>Compari tra gli sviluppatori <br> in evidenza per 144 ore</p>
                    <div class="card-back platinum">
                        <a href="#" class="submit" id="submit-button-3" data-amount="9.99" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">144 Ore: €9.99</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div id="dropin-container-modal" style="display: flex;justify-content: center;align-items: center;">
                        </div>
                        <div style="display: flex;justify-content: center;align-items: center; color: white">
                            <a id="submit-button-modal" class="btn btn-sm btn-success d-none">Submit payment</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <script>
        // Function to perform payment with Braintree Drop-in
        function performPayment(amount) {
            // Select the payment button inside the modal
            let button = document.querySelector('#submit-button-modal');
            button.classList.remove('d-none');

            // Create the Braintree Drop-in instance inside the modal
            braintree.dropin.create({
                authorization: '{{ $token }}',
                container: '#dropin-container-modal'
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
                                    document.getElementById('exampleModal').style.display =
                                        'none';
                                    window.location.reload();
                                } else {
                                    console.log('error', payload.nonce);
                                    alert('Payment failed');
                                    // Close the modal after payment failure
                                    document.getElementById('exampleModal').style.display =
                                        'none';
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

    // Aggiungi un listener per il click sui pulsanti di ciascuna card
    document.querySelectorAll('.submit').forEach(function(button) {
        button.addEventListener('click', function() {
            const amount = button.getAttribute('data-amount');
            performPayment(amount);
        });
    });

        
    </script>
@endsection
