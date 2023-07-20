@extends('layouts.app')

@section('content')
<div class="text-center mt-3 text-uppercase fw-bold fs-3">Ecco il tuo profilo da sviluppatore!</div>

<div class="container mb-5">

    {{-- dati utente --}}
    <div class="border-bottom mb-3">
        <div class="mb-3">
            <span>Nome:</span>
            <div class="fw-bold">{{ $profile['name'] }}</div>
        </div>
        <div class="mb-3">
            <span>Cognome:</span>
            <div class="fw-bold">{{ $profile['surname'] }}</div>
        </div>
        <div class="mb-3">
            <span>Email:</span>
            <div class="fw-bold">{{ $profile['email'] }}</div>
        </div>
        <div class="mb-2">
            <span>Indirizzo:</span>
            <div class="fw-bold">{{ $profile['address'] }}</div>
        </div>
    </div>
    
    {{-- dati profilo --}}
    <div class="mb-3">
        <span>Data di nascita:</span>

        @if ($profile['birth_date'])
            <div class="fw-bold">{{ $profile['birth_date'] }}</div>
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif
       
    </div>

    <div class="mb-3">
        <span>Numero di telefono:</span>

        @if ($profile['phone_number'])
            <div class="fw-bold">{{ $profile['phone_number'] }}</div>
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif
    </div>
    
    <div class="mb-3">
        <span>Github:</span>

        @if ($profile['github_url'])
            <div class="fw-bold">{{ $profile['github_url'] }}</div>
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif

    </div>

    <div class="mb-3">
        <span>Linkedin:</span>
        
        @if ($profile['linkedin_url'])
            <div class="fw-bold">{{ $profile['linkedin_url'] }}</div>
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif
    </div>

    {{-- fields --}}
    <div class="form-group mb-3">
        <div>
            Ambiti di svilluppo:
        </div>

        @if (count($user->fields) != 0)
            <div class="d-flex flex-wrap">

                @foreach ($fields as $fieldElem)
                    <div class="ms-4 d-flex">
                        <div class="fw-bold text-capitalize">{{$fieldElem->name}}</div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif
    </div>

    {{-- technologies --}}
    <div class="form-group mb-3">
        <div >
            Tecnologie di svilluppo:
        </div>

        @if (count($profile->technologies) != 0)
            <div class="d-flex flex-wrap">

                @foreach ($technologies as $techElem)
                    <div class="ms-4 d-flex">
                        <div class="fw-bold text-capitalize">{{$techElem->name}}</div>
                    </div>
                @endforeach
            </div> 
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif

        
    </div>

    {{-- Immagine profilo --}}
    <div class="mb-3">
        <div>Immagine di profilo:</div>

        @if ($profile['profile_image'])
            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="" style="max-width: 400px; max-height: 300px;">
        @else
            <div class="fw-light fst-italic text-secondary">Nessuna immagine inserita</div>
        @endif
       
    </div>

    {{-- Curriculum --}}
    <div class="mb-3">
        <span>Curriculum:</span>

        @if ($profile['curriculum'])
            <a href="{{ asset('storage/' . $profile->curriculum) }}" download="{{ $profile['name'] }}-{{ $profile['surname'] }}-CV">Scarica il tuo curriculum</a>
        @else
            <div class="fw-light fst-italic text-secondary">Nessuna curriculum aggiunto</div>
        @endif
    </div>

    {{-- Perfomance --}}
    <div class="mb-3">
        <span>Performance:</span>

        @if ($profile['performance'])
            <div class="fw-bold text-capitalize">{{ $profile['performance'] }}</div>
        @else
            <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
        @endif
    </div>

    {{-- bottoni --}}
    <div class="d-flex justify-content-end">
        {{-- bottone edit --}}
        <div class="">
            <a class="btn btn-warning" href=" {{ route('admin.edit', $profile) }} " class="my-2 btn btn-primary">Modifica</a>
        </div>
        <!-- Button trigger delete modal -->
        <button type="button" class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#modale-delete">
            Elimina Profilo
        </button>
    </div>
    
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
                    <form class="m-auto" action="{{ route('admin.destroy', $profile) }}" method="POST">
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