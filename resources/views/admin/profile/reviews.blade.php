@extends('layouts.app')

@section('content')
<h1 class="text-center">Le tue recensioni</h1>
<div class="container">
    <h4>Voto medio: {{round($averageRating, 1)}}</h4>
    @if (count($profile_review) > 0 )
        @foreach ($profile_review as $elem)
        <div class="mb-3 border p-2">
            <div>Data: {{ date('d m Y', strtotime($elem->date)) }}</div>
            <div>Nome: {{$elem->name}}</div>
            <div>Cognome: {{$elem->surname}}</div>
            @for ($i = 0; $i < 5; $i++)
                <span><i class="{{$i < $elem->vote ? 'fa-solid fa-star text-warning':'fa-regular fa-star text-warning'}}"></i></span>            
            @endfor
            <div>Descrizione: {{$elem->description}}</div>
        </div>
        @endforeach
    @else
        <h2 class="text-center">Non hai ancora ricevuto nessuna recensione</h2>
    @endif
    
</div>
@endsection

