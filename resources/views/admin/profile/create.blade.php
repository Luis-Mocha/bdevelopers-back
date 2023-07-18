@extends('layouts.app')

@section('content')

<div class="container">
    <p class="text-center fs-2 my-5 text-uppercase">Aggiungi un profilo a questo sito internet</p>
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        {{-- INPUT NOME --}}
        <div class="mb-3">
            <label class="form-label">Nome *</label>
            <input name="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="Inserisci il tuo nome (max 30 caratteri)" required maxlength="30" autofocus>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- INPUT COGNOME --}}
        <div class="mb-3">
            <label class="form-label">Cognome *</label>
            <input name="surname" type="text" class="form-control" value="{{ old('surname') }}" placeholder="Inserisci il tuo cognome (max 40 caratteri)" required maxlength="40">
            @error('surname')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- INPUT BIRTH DATE --}}
        <div class="mb-3">
            <label class="form-label">Data di nascita</label>
            <input name="birth_date" type="date" class="form-control" value="{{ old('birth_date') }}">
            @error('birth_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- INPUT INDIRIZZO --}}
        <div class="mb-3">
            <label class="form-label">Indirizzo *</label>
            <input name="address" type="text" class="form-control" value="{{ old('address') }}" placeholder="Inserisci il tuo indirizzo (max 100 caratteri)" required maxlength="100">
            @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- INPUT PHONE NUMBER --}}
        <div class="mb-3">
            <label class="form-label">Numero di telefono</label>
            <input name="phone_number" type="tel" class="form-control" value="{{ old('phone_number') }}" required minlength="8" maxlength="13" placeholder="Inserisci il tuo numero di telefono">
            @error('phone_number')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- EMAIL --}}
        <div class="mb-3">
            <label class="form-label">Email *</label>
            <input name="email" type="email" class="form-control" value="{{ old('email') }}" required placeholder="Inserisci la tua email">
            @error('email')
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
        {{-- <div class="form-group mt-3 mb-4 d-flex">
            <div style="width:35%">
                Ambiti di svilluppo:
            </div>
            <div class="d-flex flex-wrap w-25">
              
                @foreach ($fields as $elem)
                    <div class="ms-4 d-flex">
                        <input class="me-2" type="checkbox" id="input-field-{{$elem->id}}" value="{{$elem->id}}" name="fields[]" {{ in_array( $elem->id, old('fields', [] ) ) ? 'checked' : '' }}>
                        <label for="input-field-{{$elem->id}}" class="form-label text-capitalize">
                            {{$elem->name}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div> --}}
        
       {{-- technologies --}}
        <div class="form-group mt-3 mb-4 d-flex">
            <div style="width:35%">
                Tecnologie di svilluppo:
            </div>
            <div class="d-flex flex-wrap w-25">
              
                @foreach ($technologies as $elem)
                    <div class="ms-4 d-flex">
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
            <input name="performance" type="text" class="form-control" value="{{ old('performance') }}" required placeholder="Inserisci le tue performance">
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

            reader.onload = function (e) {
                const imgPreview = document.getElementById('img-preview');
                imgPreview.setAttribute("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>


@endsection

