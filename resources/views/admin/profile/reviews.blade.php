@extends('layouts.back')

@section('content')
<h1 class="page-title">Le tue recensioni</h1>
<div class="container">
    <h4 class="label-vote">Media voti: {{round($averageRating, 1)}}</h4>
    @if (count($profile_review) > 0 )
        @foreach ($profile_review as $elem)
        <div id="box-review" class="mb-3 p-2">
            <div id="box-dati">
                <div>
                    <span class="review-info text-capitalize">{{$elem->name}}</span>
                    <span class="review-info text-capitalize">{{$elem->surname}}</span><br>
                </div>
                <div>    
                    <span class="label">Data: </span>
                    <span class="review-info">{{ date('d m Y', strtotime($elem->date)) }}</span><br>
                </div>
            </div>
            @for ($i = 0; $i < 5; $i++)
                <span><i class="{{$i < $elem->vote ? 'fa-solid fa-star star':'fa-regular fa-star star'}}"></i></span>            
            @endfor
            <div class="review-description">{{$elem->description}}</div>
        </div>
        @endforeach
    @else
        <h2 class="text-center">Non hai ancora ricevuto nessuna recensione</h2>
    @endif
    
</div>
@endsection

