@extends('layouts.app')

@section('content')
<h1 class="text-center mt-3 text-uppercase">sono la index</h1>

<div class="container">
    @foreach ($profile as $elem)
    <div>
        <h2>NOME:</h2>
        <h3 class="mb-3">{{ $elem['name'] }}</h3>
    </div>
    <div>
        <h2>Cognome:</h2>
        <h3 class="mb-3">{{ $elem['surname'] }}</h3>
    </div>
    <div>
        <h2>Data di nascita:</h2>
        <h3 class="mb-3 ">{{ $elem['birth_date'] }}</h3>
    </div>
    <div>
        <h2>Numero di telefono:</h2>
        <h3 class="mb-3">{{ $elem['phone_number'] }}</h3>
    </div>
    <div>
        <h2>Email:</h2>
        <h3 class="mb-3">{{ $elem['email'] }}</h3>
    </div>
    <div>
        <h2>Github:</h2>
        <h3 class="mb-3">{{ $elem['github_url'] }}</h3>
    </div>
    <div>
        <h2>Linkedin:</h2>
        <h3 class="mb-3">{{ $elem['linkedin_url'] }}</h3>
    </div>
    
    {{-- Immagine profilo --}}
    <div>
        <h2>Immagine di profilo:</h2>
        <img src="{{ asset('storage/' . $elem->profile_image) }}" alt="">
    </div>

    {{-- Curriculum --}}
    <div>
        <h2>Curriculum:</h2>
        <a href="{{ asset('storage/' . $elem->curriculum) }}" download="{{ $elem['name'] }}-{{ $elem['surname'] }}-CV">Scarica il tuo curriculum</a>
    </div>

    {{-- Perfomance --}}
    <div>
        <h2>Performance:</h2>
        <h3 class="mb-3 text-uppercase">{{ $elem['performance'] }}</h3>
    </div>
    <div>
        <a class="text-decoration-none" href=" {{ route('admin.edit', $elem) }} " class="my-2 btn btn-primary">Modifica</a>
    </div>

    @endforeach
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Elimina account
    </button>
    <div class="modal" tabindex="-1" id="exampleModal">
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