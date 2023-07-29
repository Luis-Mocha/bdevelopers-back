@extends('layouts.app')

@section('content')

<div class="container form-backend">
    <h1 class="">Modifica il tuo profilo</h1>

    <form id="editForm" action="{{ route('admin.update', $profile_id['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        {{-- informazioni utente --}}
        <div class="userInfo-box">
            {{-- <div class="fw-light text-secondary text-end">*Informazioni Utente</div> --}}
            <button  class="user-tooltip" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="I seguenti dati corrispondono alle informazioni Utente.">
                ?
            </button>

            {{-- INPUT NOME --}}
            <div class="mb-2">
                <label class="form-label">Nome:</label>
                <span class="index-info ms-2">{{ old('name') ?? $profile_id->name }}</span>
                <input hidden name="name" type="text" value="{{ old('name') ?? $profile_id->name }}" required maxlength="30" readonly>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- INPUT COGNOME--}}
            <div class="mb-2">
                <label class="form-label">Cognome:</label>
                <span class="index-info ms-2">{{ old('surname') ?? $profile_id->surname }}</span>
                <input hidden name="surname" type="text" value="{{ old('surname') ?? $profile_id->surname }}"required maxlength="40" readonly>
                @error('surname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="mb-2">
                <label class="form-label m-0">Email:</label>
                <div class="index-info">{{ old('email') ?? $profile_id->email }}</div>
                <input hidden name="email" type="email" value="{{ old('email') ?? $profile_id->email }}" readonly>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- INPUT INDIRIZZO --}}
            <div class="mb-2">
                <label class="form-label m-0">Indirizzo:</label>
                <div class="index-info">{{ old('address') ?? $profile_id->address }}</div>
                <input hidden name="address" type="text" value="{{ old('address') ?? $profile_id->address}}" maxlength="100" readonly>
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="profileInfo-box">
        
            <p class="fw-light text-secondary text-center">* Seleziona sempre <u>almeno</u> un ambito di sviluppo. Gli altri dati non sono obbligatori, ma ricorda che un profilo completo viene visitato più spesso!</p>

            {{-- INPUT BIRTH DATE --}}
            <div class="mb-3">
                <label class="form-label">Data di nascita</label>
                <input name="birth_date" type="date" class="form-control" value="{{ old('birth_date') ?? $profile_id->birth_date }}" autofocus>
                @error('birth_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- INPUT PHONE NUMBER --}}
            <div class="mb-3">
                <label class="form-label">Numero di telefono</label>
                <input name="phone_number" type="tel" class="form-control" value="{{ old('phone_number') ?? $profile_id->phone_number }}" minlength="8" maxlength="13">
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
            <div style="visibility:hidden; color:red; " id="chk_option_error">
                Seleziona almeno un ambito di sviluppo
            </div>
            <div id="edit-fields" class="form-group mt-3 mb-4">
                <div class="form-label">
                    Ambiti di svilluppo:
                </div>
                @error('fields')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="row">
                    @foreach ($fields as $elem)
                    <div class="col-3 col-sm-2 d-flex align-items-center ms-4 mb-3">
                        @if ($errors->any())
                            <input class="field-checks" type="checkbox" id="input-field-{{$elem->id}}" value="{{$elem->id}}" name="fields[]" {{ in_array( $elem->id, old('fields', [] ) ) ? 'checked' : '' }}>  
                        @else
                            {{-- nessun errore --}}
                            <input class="field-checks" type="checkbox" id="input-field-{{$elem->id}}" value="{{$elem->id}}" name="fields[]" {{ $currentUser->fields->contains($elem) ? 'checked' : '' }}>
                        @endif

                        <label for="input-field-{{$elem->id}}" class="text-capitalize ms-1">
                            {{$elem->name}}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Checkbox techs --}}
            <div class="form-group mt-3 mb-4">
                <div  class="form-label">
                    Tecnologie di svilluppo:
                </div>
                <div class="row">
                    @foreach ($technologies as $elem)
                    <div class="col-3 col-sm-2 d-flex align-items-center ms-4 mb-2">
                        {{-- checkbox con valori precedenti --}}
                        @if ($errors->any())
                            <input type="checkbox" id="input-technology-{{$elem->id}}" value="{{$elem->id}}" name="technologies[]" {{ in_array( $elem->id, old('technologies', [] ) ) ? 'checked' : '' }}> 
                        @else
                            {{-- nessun errore --}}
                            <input type="checkbox" id="input-technology-{{$elem->id}}" value="{{$elem->id}}" name="technologies[]" {{ $profile_id->technologies->contains($elem) ? 'checked' : '' }}>
                        @endif

                        <label for="input-technology-{{$elem->id}}" class="text-capitalize ms-1">
                            {{$elem->name}}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between">
                <div>
                    {{-- PROFILE IMAGE --}}
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Immagine di profilo</label>
                        <input type="file" class="form-control" name="profile_image" id="profile_image" accept=".jpg,.png,.jpg,.gif" aria-describedby="fileHelpId" onchange="readURL(this);">
                    </div>
                    {{-- CV --}}
                    <div class="mb-3">
                        <label class="form-label">Curriculum</label>
                        <input name="curriculum" type="file" class="form-control" accept=".pdf">
                        @error('curriculum')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="">Anteprima immagine:</div>
                    
                        <img id="img-preview" src="{{ asset('storage/' . $profile_id->profile_image) }}" alt="Immagine Profilo preview">
                        {{-- <div class="text-secondary fw-light fst-italic">Nessuna immagine di profilo</div> --}}
                </div> 
            </div>
            
            {{-- PERFORMANCE --}}
            <div class="mb-3">
                <label class="form-label">Perfomance</label>
                <input name="performance" type="text" class="form-control" value="{{ old('performance') ?? $profile_id->performance  }}">
                @error('performance')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <button type="submit" class="form-button">Modifica</button>

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
       let checkboxes = document.querySelectorAll('input.field-checks');
       let isChecked = false
       checkboxes.forEach(function(checkbox) {
         if (checkbox.checked) {
           isChecked = true;
         }
       })
       if (!isChecked) {

            document.getElementById("chk_option_error").style.visibility = "visible";

            document.getElementById('chk_option_error').scrollIntoView({
                behavior: 'smooth'
            });
            return false; // Impedisce l'invio del form
       }
       // Se almeno una checkbox è stata selezionata, il form viene inviato normalmente
       return true;
    }
     // Ottieni il riferimento al form
     let editForm = document.getElementById('editForm')
     // Assegna la funzione di validazione all'evento onsubmit del form
     editForm.onsubmit = validateForm;
</script>


@endsection