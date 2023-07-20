@extends('layouts.app')

@section('content')
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif --}}

<div class="container">
    <p class="text-center fs-2 my-5 text-uppercase">Modifica il tuo profilo</p>
    <form id="myForm" action="{{ route('admin.update', $profile_id['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        <div class="border-bottom border-end border-primary mb-3 pe-4">
            <div class="fw-light text-secondary text-end">*Informazioni Utente</div>

            {{-- INPUT NOME --}}
            <div class="mb-3">
                <label class="form-label">Nome *</label>
                <input name="name" type="text" class="form-control" value="{{ old('surname') ?? $profile_id->name }}" placeholder="Inserisci il tuo nome (max 30 caratteri)" required maxlength="30" readonly>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- INPUT COGNOME--}}
            <div class="mb-3">
                <label class="form-label">Cognome *</label>
                <input name="surname" type="text" class="form-control " value="{{ old('surname') ?? $profile_id->surname }}" placeholder="Inserisci il tuo nome (max 40 caratteri)" required maxlength="40" readonly>
                @error('surname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label">Email *</label>
                <input name="email" type="email" class="form-control " value="{{ old('email') ?? $profile_id->email  }}" readonly>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- INPUT INDIRIZZO --}}
            <div class="mb-3">
                <label class="form-label">Indirizzo *</label>
                <input name="address" type="text" class="form-control" value="{{ old('address') ?? $profile_id->address}}" placeholder="Inserisci il tuo indirizzo (max 100 caratteri)" maxlength="100" readonly>
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- INPUT BIRTH DATE --}}
        <div class="mb-3">
            <label class="form-label">Data di nascita</label>
            <input name="birth_date" type="date" class="form-control " value="{{ old('birth_date') ?? $profile_id->birth_date }}" autofocus>
            @error('birth_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        {{-- INPUT PHONE NUMBER --}}
        <div class="mb-3">
            <label class="form-label">Numero di telefono</label>
            <input name="phone_number" type="tel" class="form-control " value="{{ old('phone_number') ?? $profile_id->phone_number }}" minlength="8" maxlength="13">
            @error('phone_number')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        {{-- GITHUB URL --}}
        <div class="mb-3">
            <label class="form-label">Github/URL</label>
            <input name="github_url" type="url" class="form-control" value="{{ old('github_url') ?? $profile_id->github_url  }}">
            @error('github_url')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- LINKEDIN URL --}}
        <div class="mb-3">
            <label class="form-label">Linkedin/URL</label>
            <input name="linkedin_url" type="url" class="form-control" value="{{ old('linkedin_url') ?? $profile_id->linkedin_url  }}">
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
                <div style="visibility:hidden; color:red; " id="chk_option_error">
                    Seleziona almeno un ambito di sviluppo
                </div>
                @foreach ($fields as $elem)
                <div class="ms-4 col-2">
                    @if ($errors->any())

                        <input class="field-checks" type="checkbox" id="input-field-{{$elem->id}}" value="{{$elem->id}}" name="fields[]" {{ in_array( $elem->id, old('fields', [] ) ) ? 'checked' : '' }}>
                            
                    @else
                        {{-- nessun errore --}}
                        <input class="field-checks" type="checkbox" id="input-field-{{$elem->id}}" value="{{$elem->id}}" name="fields[]" {{ $currentUser->fields->contains($elem) ? 'checked' : '' }}>
                        
                    @endif

                    <label for="input-field-{{$elem->id}}" class="form-label text-capitalize">
                        {{$elem->name}}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Checkbox techs --}}
        <div class="form-group mt-3 mb-4 d-flex">
            <div style="width:35%">
                Tecnologie di svilluppo:
            </div>
            <div class="row">

                @foreach ($technologies as $elem)
                <div class="ms-4  col-2">
                    {{-- checkbox con valori precedenti --}}
                    @if ($errors->any())
                        <input type="checkbox" id="input-technology-{{$elem->id}}" value="{{$elem->id}}" name="technologies[]" {{ in_array( $elem->id, old('technologies', [] ) ) ? 'checked' : '' }}> 
                    @else
                        {{-- nessun errore --}}
                        <input type="checkbox" id="input-technology-{{$elem->id}}" value="{{$elem->id}}" name="technologies[]" {{ $profile_id->technologies->contains($elem) ? 'checked' : '' }}>
                    @endif

                    <label for="input-technology-{{$elem->id}}" class="form-label text-capitalize">
                        {{$elem->name}}
                    </label>
                </div>
                @endforeach
            </div>
        </div>


        <div>
            <div class="fs-5">Anteprima immagine:</div>
            <img id="img-preview" src="{{ asset('storage/' . $profile_id->profile_image) }}" alt="" style="max-width: 400px; max-height: 300px;">
        </div>
        {{-- PROFILE IMAGE --}}
        <div class="mb-3">
            <label for="profile_image" class="form-label">Immagine di profilo</label>
            <input type="file" class="form-control" name="profile_image" id="profile_image" accept=".jpg,.png,.jpg,.gif" aria-describedby="fileHelpId" onchange="readURL(this);">
        </div>
        {{-- CV --}}
        <div class="mb-3">
            <label class="form-label">Curriculum</label>
            <input name="curriculum" type="file" class="form-control " accept=".pdf">
            @error('curriculum')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- PERFORMANCE --}}
        <div class="mb-3">
            <label class="form-label">Perfomance</label>
            <input name="performance" type="text" class="form-control" value="{{ old('performance') ?? $profile_id->performance  }}">
            @error('performance')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">MODIFICA</button>

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
    }; 

    function validateForm() {
      var checkboxes = document.querySelectorAll('input.field-checks');
      var isChecked = false;

      checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
          isChecked = true;
        }
      });

      if (!isChecked) {
        // alert('Seleziona almeno una checkbox Ambito prima di inviare il form.');
        document.getElementById("chk_option_error").style.visibility = "visible";
        return false; // Impedisce l'invio del form
      }
      // Se almeno una checkbox è stata selezionata, il form viene inviato normalmente
      return true;
    }

    // Ottieni il riferimento al form
    var myForm = document.getElementById('myForm');

    // Assegna la funzione di validazione all'evento onsubmit del form
    myForm.onsubmit = validateForm;
</script>


@endsection