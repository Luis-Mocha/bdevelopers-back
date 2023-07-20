@extends('layouts.app')

@section('content')

<div class="container">
    <p class="text-center fs-2 my-5 text-uppercase">Aggiungi un profilo a questo sito internet</p>
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <div class="border-bottom border-end border-primary mb-3 pe-4">
            <div class="fw-light text-secondary text-end">*Informazioni Utente</div>

            {{-- INPUT NOME --}}
            <div class="mb-3">
                <label class="form-label">Nome *</label>
                <input name="name" type="text" class="form-control" value="{{ $currentUser->name }}" placeholder="Inserisci il tuo nome (max 30 caratteri)" required maxlength="30" readonly>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- INPUT COGNOME --}}
            <div class="mb-3">
                <label class="form-label">Cognome *</label>
                <input name="surname" type="text" class="form-control" value="{{ $currentUser->surname }}" placeholder="Inserisci il tuo cognome (max 40 caratteri)" required maxlength="40" readonly>
                @error('surname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label">Email *</label>
                <input name="email" type="email" class="form-control" value="{{ $currentUser->email }}" required placeholder="Inserisci la tua email" readonly>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- INPUT INDIRIZZO --}}
            <div class="mb-3">
                <label class="form-label">Indirizzo *</label>
                <input name="address" type="text" class="form-control" value="{{ $currentUser->address }}" placeholder="Inserisci il tuo indirizzo (max 100 caratteri)" maxlength="100" readonly>
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- INPUT BIRTH DATE --}}
        <div class="mb-3">
            <label class="form-label">Data di nascita</label>
            <input name="birth_date" type="date" class="form-control" value="{{ old('birth_date') }}" autofocus>
            @error('birth_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        {{-- INPUT PHONE NUMBER --}}
        <div class="mb-3">
            <label class="form-label">Numero di telefono</label>
            <input name="phone_number" type="tel" class="form-control" value="{{ old('phone_number') }}" minlength="8" maxlength="13" placeholder="Inserisci il tuo numero di telefono">
            @error('phone_number')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        {{-- GITHUB URL --}}
        <div class="mb-3">
            <label class="form-label">Github/URL</label>
            <input name="github_url" type="url" class="form-control" value="{{ old('github_url') }}" placeholder="Inserisci il tuo profilo GitHub">
            @error('github_url')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- LINKEDIN URL --}}
        <div class="mb-3">
            <label class="form-label">Linkedin/URL</label>
            <input name="linkedin_url" type="url" class="form-control" value="{{ old('linkedin_url') }}" placeholder="Inserisci il tuo profilo LinkedIn">
            @error('linkedin_url')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- fields --}}
        <div class="form-group mt-3 mb-4 d-flex">
            <div>
                Ambiti di svilluppo:
            </div>
            <div class="row">

                @foreach ($fields as $elem)
                <div class="ms-4 col-2">
                    {{-- checkbox con valori precedenti --}}
                    @if ($errors->any())
                        <input type="checkbox" id="input-field-{{$elem->id}}" value="{{$elem->id}}" name="fields[]" {{ in_array( $elem->id, old('fields', [] ) ) ? 'checked' : '' }}> 
                    @else
                        {{-- nessun errore --}}
                        <input type="checkbox" id="input-field-{{$elem->id}}" value="{{$elem->id}}" name="fields[]" {{ $currentUser->fields->contains($elem) ? 'checked' : '' }}>
                    @endif

                    <label for="input-field-{{$elem->id}}" class="form-label text-capitalize">
                        {{$elem->name}}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- technologies --}}
        <div class="form-group mt-3 mb-4 d-flex">
            <div style="width:35%">
                Tecnologie di svilluppo:
            </div>
            <div class="row">

                @foreach ($technologies as $elem)
                <div class="ms-4 col-2">
                    <input class="me-2" type="checkbox" id="input-technology-{{$elem->id}}" value="{{$elem->id}}" name="technologies[]" {{ in_array( $elem->id, old('technologies', [] ) ) ? 'checked' : '' }}>
                    <label for="input-technology-{{$elem->id}}" class="form-label text-capitalize">
                        {{$elem->name}}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <img id="img-preview" src="http://placehold.it/180" alt="your image" />
        {{-- PROFILE IMAGE --}}
        <div class="mb-3">
            <label for="profile_image" class="form-label">Immagine di profilo</label>
            <input type="file" class="form-control" name="profile_image" id="profile_image" aria-describedby="fileHelpId" accept=".jpg,.png,.jpg,.gif" onchange="readURL(this);">
            @error('profile_image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- CV --}}
        <div class="mb-3">
            <label class="form-label">Curriculum</label>
            <input name="curriculum" type="file" class="form-control" accept=".pdf">
            @error('curriculum')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- PERFORMANCE --}}
        <div class="mb-3">
            <label class="form-label">Perfomance *</label>
            <input name="performance" type="text" class="form-control" value="{{ old('performance') }}" placeholder="Inserisci le tue performance">
            @error('performance')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">CREA</button>

    </form>
</div>


<script>
    // Funzione per visualizzare l'anteprima dell'immagine
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                const imgPreview = document.getElementById('img-preview');
                imgPreview.setAttribute("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


@endsection