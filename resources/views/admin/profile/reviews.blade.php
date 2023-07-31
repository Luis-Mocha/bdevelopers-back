@extends('layouts.back')

@section('content')

<div class="container px-5">
    <h4 class="label-vote mt-5 mb-4">Media voti: {{round($averageRating, 1)}}</h4>
    @if (count($profile_review) > 0 )
        @foreach ($profile_review as $elem)
        <div id="box-review" class="mb-3 p-2">
            <div id="box-dati">
                <div>
                    <span class="review-info text-capitalize">{{$elem->name}}</span>
                    <span class="review-info text-capitalize">{{$elem->surname}}</span>
                </div>
                <div>    
                    <span class="label">Data: </span>
                    <span class="review-info">{{ date('d m Y', strtotime($elem->date)) }}</span>
                </div>
            </div>
            @for ($i = 0; $i < 5; $i++)
                <span><i class="{{$i < $elem->vote ? 'fa-solid fa-star star':'fa-regular fa-star star'}}"></i></span>            
            @endfor
            <span class="ms-2">{{$elem->vote}}/5</span>
            <div class="review-description">{{$elem->description}}</div>
        </div>
        @endforeach
    @else
        <h2 class="text-center">Non hai ancora ricevuto nessuna recensione</h2>
    @endif
    
</div>
@endsection

