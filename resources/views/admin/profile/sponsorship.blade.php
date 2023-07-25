@extends('layouts.app')


@section('content')
    <div class="py-12">
        @csrf
        <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
        <div style="display: flex;justify-content: center;align-items: center; color: white">
            <a id="submit-button" class="btn btn-sm btn-success">Submit payment</a>
        </div>
    </div>
    <script>
        let button = document.querySelector('#submit-button');
        braintree.dropin.create({
            authorization: '{{ $token }}',
            container: '#dropin-container'
        }, function(createErr, instance) {
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
                    let data = "nonce=" + encodeURIComponent(payload.nonce);
                    pagamento.send(data);
                });
            });
        });
    </script>
@endsection
