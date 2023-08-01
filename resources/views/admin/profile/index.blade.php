@extends('layouts.back')

@section('content')

<div class="contenuto-index my-5 d-md-flex">

    {{-- dati scritti --}}
    <div id="left-index" class="col-12 col-md-6">
        {{-- dati utente --}}
        <div class="">
            <div class="mb-3">
                <span class="label">Nome:</span>
                <div class="fw-bold index-info">{{ $profile['name'] }}</div>
            </div>
            <div class="mb-3">
                <span class="label">Cognome:</span>
                <div class="fw-bold index-info">{{ $profile['surname'] }}</div>
            </div>
            <div class="mb-3">
                <span class="label">Email:</span>
                <div class="fw-bold index-info">{{ $profile['email'] }}</div>
            </div>
            <div class="mb-3">
                <span class="label">Indirizzo:</span>
                <div class="fw-bold index-info">{{ $profile['address'] }}</div>
            </div>
        </div>

        {{-- dati profilo --}}
        <div class="mb-3">
            <span class="label">Data di nascita:</span>

            @if ($profile['birth_date'])
                <div class="fw-bold index-info">{{ $profile['birth_date'] }}</div>
            @else
                <div class="fw-light fst-italic text-secondary index-info">Nessun dato inserito</div>
            @endif
        
        </div>

        <div class="mb-3">
            <span class="label">Numero di telefono:</span>

            @if ($profile['phone_number'])
                <div class="fw-bold index-info">{{ $profile['phone_number'] }}</div>
            @else
                <div class="fw-light fst-italic text-secondary index-info">Nessun dato inserito</div>
            @endif
        </div>
        
        <div class="mb-3">
            <span class="label">Github:</span>

            @if ($profile['github_url'])
                <div class="fw-bold index-info">{{ $profile['github_url'] }}</div>
            @else
                <div class="fw-light fst-italic text-secondary index-info">Nessun dato inserito</div>
            @endif

        </div>

        <div class="mb-3">
            <span class="label">Linkedin:</span>
            
            @if ($profile['linkedin_url'])
                <div class="fw-bold index-info">{{ $profile['linkedin_url'] }}</div>
            @else
                <div class="fw-light fst-italic text-secondary index-info">Nessun dato inserito</div>
            @endif
        </div>

        {{-- fields --}}
        <div class="form-group mb-3">
            <div class="label">
                Ambiti di svilluppo:
            </div>

            @if (count($user->fields) != 0)
                <div class="d-flex flex-wrap">

                    @foreach ($fields as $fieldElem)
                        <div class="ms-4 d-flex">
                            <div class="fw-bold text-capitalize index-info">{{$fieldElem->name}}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="fw-light fst-italic text-secondary index-info">Nessun dato inserito</div>
            @endif
        </div>

        {{-- technologies --}}
        <div class="form-group mb-3">
            <div class="label">
                Tecnologie di svilluppo:
            </div>

            @if (count($profile->technologies) != 0)
                <div class="d-flex flex-wrap">

                    @foreach ($technologies as $techElem)
                        <div class="ms-4 d-flex">
                            <div class="fw-bold text-capitalize index-info">{{$techElem->name}}</div>
                        </div>
                    @endforeach
                </div> 
            @else
                <div class="fw-light fst-italic text-secondary index-info">Nessun dato inserito</div>
            @endif

            
        </div>

        {{-- Curriculum --}}
        <div class="mb-3">
            <span class="label">Curriculum:</span>

            @if ($profile['curriculum'])
            <button class="btn-cv">
                <a href="{{ asset('storage/' . $profile->curriculum) }}" target="_blank" >
                    <i class="fa-solid fa-file-pdf"></i>
                    Scarica
                </a>
            </button>
            @else
                <div class="fw-light fst-italic text-secondary">Nessuna curriculum aggiunto</div>
            @endif
        </div>

        {{-- Perfomance --}}
        <div class="mb-3">
            <span class="label">Performance:</span>

            @if ($profile['performance'])
                <div class="fw-bold text-capitalize">{{ $profile['performance'] }}</div>
            @else
                <div class="fw-light fst-italic text-secondary">Nessun dato inserito</div>
            @endif
        </div>

        <button class="btn-cv mb-3 d-md-block m-auto">
            <a href="http://localhost:5174/developer/{{$profile['id']}}" target="_blank">
                Visualizza come gli altri vedono il tuo profilo
                <i class="fa-solid fa-up-right-from-square"></i>
            </a>
        </button>

    </div>

    {{-- parte destra pagina --}}
    <div id="right-index" class="mb-3 col-12 col-md-6">

        {{-- immagine profilo --}}
        <div class="d-flex justify-content-center justify-content-md-end mb-5">
            @if ($profile['profile_image'])
            <img class="profile-img" src="{{ asset('storage/' . $profile->profile_image) }}" alt="">
            @else
                <div class="fw-light fst-italic text-secondary">Nessuna immagine inserita</div>
            @endif
        </div>
        
        {{-- bottoni --}}
        <div class="d-flex justify-content-end">
            {{-- bottone edit --}}
            <button class="icon-button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Modifica il tuo profilo" data-bs-custom-class="edit-tooltip">  
                <a href=" {{ route('admin.edit', $profile) }} ">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </button>

            {{-- bottone delete --}}
            <button  class="icon-button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Elimina il tuo profilo" data-bs-custom-class="delete-tooltip">
                <i data-bs-toggle="modal" data-bs-target="#modale-delete" class="fa-solid fa-trash"></i>
            </button>
        </div>
    
    </div>
</div>

{{-- modale eliminazione profilo --}}
<div class="modal" tabindex="-1" id="modale-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminazione profilo</h5>
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

@endsection