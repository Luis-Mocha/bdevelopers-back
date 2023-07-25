@extends('layouts.app')


@section('content')

<div id="dropin-container"></div>
<button id="submit-button">Request payment method</button>
<script>
    var button = document.querySelector('#submit-button');

    braintree.dropin.create({
        authorization: 'CLIENT_AUTHORIZATION',
        container: '#dropin-container'
    }, function(createErr, instance) {
        button.addEventListener('click', function() {
            instance.requestPaymentMethod(function(requestPaymentMethodErr, payload) {
                // Submit payload.nonce to your server
            });
        });
    });
</script>
@endsection