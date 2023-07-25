@extends('layouts.app')

@section('content')
    <h1 class="text-center">I tuoi messaggi</h1>
    <div class="container">
        <h4>Messaggi ricevuti</h4>
        @if (count($profile_leads) > 0)
            @foreach ($profile_leads as $elem)
                <div class="mb-3 border p-2">
                    <div>Nome: {{ $elem->name }}</div>
                    <div>Cognome: {{ $elem->surname }}</div>
                    <div>email: {{ $elem->email }}</div>
                    <div>Messaggio: {{ $elem->message }}</div>
                    <div>Data: {{ $elem->created_at }}</div>
                </div>
            @endforeach
        @else
            <h2 class="text-center">Non hai ancora ricevuto nessuna recensione</h2>
        @endif
    </div>
@endsection
