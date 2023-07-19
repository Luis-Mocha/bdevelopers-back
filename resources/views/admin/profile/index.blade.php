@extends('layouts.app')

@section('content')
<div class="text-center mt-3 text-uppercase fw-bold fs-3">Ecco il tuo profilo da sviluppatore!</div>

<div class="container mb-5">
    @foreach ($profile as $elem)
    {{-- dati utente --}}
    <div class="border-bottom mb-3">
        <div class="mb-3">
            <span>Nome:</span>
            <div class="fw-bold">{{ $elem['name'] }}</div>
        </div>
        <div class="mb-3">
            <span>Cognome:</span>
            <div class="fw-bold">{{ $elem['surname'] }}</div>
        </div>
        <div class="mb-3">
            <span>Email:</span>
            <div class="fw-bold">{{ $elem['email'] }}</div>
        </div>
        <div class="mb-2">
            <span>Indirizzo:</span>
            <div class="fw-bold">{{ $elem['address'] }}</div>
        </div>
    </div>
    
    {{-- dati profilo --}}
    <div class="mb-3">
        <span>Data di nascita:</span>

        @if ($elem['birth_date'])
            <div class="fw-bold ">{{ $elem['birth_date'] }}</div>
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif
       
    </div>

    <div class="mb-3">
        <span>Numero di telefono:</span>

        @if ($elem['phone_number'])
            <div class="fw-bold ">{{ $elem['phone_number'] }}</div>
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif
    </div>
    
    <div class="mb-3">
        <span>Github:</span>

        @if ($elem['github_url'])
            <div class="fw-bold ">{{ $elem['github_url'] }}</div>
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif

    </div>

    <div class="mb-3">
        <span>Linkedin:</span>
        
        @if ($elem['linkedin_url'])
            <div class="fw-bold ">{{ $elem['linkedin_url'] }}</div>
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif
    </div>
    
    {{-- Immagine profilo --}}
    <div class="mb-3">
        <span>Immagine di profilo:</span>

        @if ($elem['profile_image'])
            <img src="{{ asset('storage/' . $elem->profile_image) }}" alt="">
        @else
            <div class="fw-light fst-italic text-secondary">Nessuna immagine inserita</div>
        @endif
       
    </div>

    {{-- Curriculum --}}
    <div class="mb-3">
        <span>Curriculum:</span>

        @if ($elem['curriculum'])
            <a href="{{ asset('storage/' . $elem->curriculum) }}" download="{{ $elem['name'] }}-{{ $elem['surname'] }}-CV">Scarica il tuo curriculum</a>
        @else
            <div class="fw-light fst-italic text-secondary">Nessuna curriculum aggiunto</div>
        @endif
    </div>

    {{-- Perfomance --}}
    <div class="mb-3">
        <span>Performance:</span>

        @if ($elem['performance'])
            <div class="fw-bold text-capitalize">{{ $elem['performance'] }}</div>
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif
    </div>

    {{-- bottoni --}}
    <div class="d-flex justify-content-end">
        {{-- bottone edit --}}
        <div class="">
            <a class="btn btn-warning" href=" {{ route('admin.edit', $elem) }} " class="my-2 btn btn-primary">Modifica</a>
        </div>
        <!-- Button trigger delete modal -->
        <button type="button" class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#modale-delete">
            Elimina account
        </button>
    </div>
    

    @endforeach
    
    {{-- modale eliminazione profilo --}}
    <div class="modal" tabindex="-1" id="modale-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Cliccando conferma eliminerai definitivamente il tuo profilo.</p>
                </div>
                <div class="modal-footer">
                    <form class="m-auto" action="{{ route('admin.destroy', $elem) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Conferma</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection