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
        <form action="{{ route('admin.update', $profile_id['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @method('PUT')

            {{-- INPUT NOME --}}
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input name="name" type="text" class="form-control" value="{{ old('name') ?? $profile_id->name }}" required maxlength="30" autofocus>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- INPUT COGNOME--}}
            <div class="mb-3">
                <label class="form-label">Cognome</label>
                <input name="surname" type="text" class="form-control " value="{{ old('surname') ?? $profile_id->surname }}" required maxlength="40">
                @error('surname')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- INPUT BIRTH DATE --}}
            <div class="mb-3">
                <label class="form-label">Data di nascita</label>
                <input name="birth_date" type="date" class="form-control " value="{{ old('birth_date') ?? $profile_id->birth_date }}" required>
                @error('birth_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- INPUT PHONE NUMBER --}}
            <div class="mb-3">
                <label class="form-label">Numero di telefono</label>
                <input name="phone_number" type="tel" class="form-control " value="{{ old('phone_number') ?? $profile_id->phone_number }}" required minlength="8" maxlength="13">
                @error('phone_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control " value="{{ old('email') ?? $profile_id->email  }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- GITHUB URL --}}
            <div class="mb-3">
                <label class="form-label">Github/URL</label>
                <input name="github_url" type="url" class="form-control" value="{{ old('github_url') ?? $profile_id->github_url  }}" required>
                @error('github_url')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- LINKEDIN URL --}}
            <div class="mb-3">
                <label class="form-label">Linkedin/URL</label>
                <input name="linkedin_url" type="url" class="form-control" value="{{ old('linkedin_url') ?? $profile_id->linkedin_url  }}" required>
                @error('linkedin_url')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- PROFILE IMAGE --}}
            <div class="mb-3">
                <label for="profile_image" class="form-label">Immagine di profilo</label>
                <input type="file" class="form-control" name="profile_image" id="profile_image" required accept=".jpg,.png,.jpg,.gif"
                    aria-describedby="fileHelpId">
            </div>
            {{-- CV --}}
            <div class="mb-3">
                <label class="form-label">Curriculum</label>
                <input name="curriculum" type="file" class="form-control " required accept=".pdf">
                @error('curriculum')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- PERFORMANCE --}}
            <div class="mb-3">
                <label class="form-label">Perfomance</label>
                <input name="performance" type="text" class="form-control" value="{{ old('performance') ?? $profile_id->performance  }}" required >
                @error('performance')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">MODIFICA</button>

        </form>
    </div>
@endsection
