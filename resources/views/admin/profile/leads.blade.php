@extends('layouts.back')

@section('content')
<h1 class="page-title">I tuoi messaggi</h1>
<div class="container">
    <h4>Messaggi ricevuti</h4>
    @if (count($profile_leads) > 0)
    @foreach ($profile_leads as $elem)
    <div id="container-leads" class="mb-3 p-2">
        <div class="box-leads">
            <div>
                <span class="leads-info text-capitalize">{{ $elem->name }}</span>
                <span class="leads-info text-capitalize">{{ $elem->surname }}</span>
                <div class="label">Inviato da: {{ $elem->email }}</div>
            </div>
            <div>
                <div class="leads-info">{{ date('d/m/Y H:i', strtotime($elem->created_at)) }}</div>        
            </div>
        </div>
        <div class="leads-description mt-3">Messaggio: {{ $elem->message }}</div>
        
        
    </div>
    @endforeach
    @else
    <h2 class="text-center">Non hai ancora ricevuto nessun messaggio</h2>
    @endif
</div>
@endsection