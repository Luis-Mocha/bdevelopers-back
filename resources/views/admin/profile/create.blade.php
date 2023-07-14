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
        <p class="text-center fs-2 my-5 text-uppercase">Aggiungi un profilo a questo sito internet</p>
        <form action="{{ route('admin.store') }}" method="POST" enctype=”multipart/form-data”>
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            {{-- INPUT NOME --}}
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input name="name" type="text" class="form-control @error('title') is-invalid @enderror">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- INPUT COGNOME --}}
            <div class="mb-3">
                <label class="form-label">Cognome</label>
                <input name="surname" type="text" class="form-control @error('subtitle') is-invalid @enderror">
                @error('surname')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- INPUT BIRTH DATE --}}
            <div class="mb-3">
                <label class="form-label">Data di nascita</label>
                <input name="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror">
                @error('birth_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- INPUT PHONE NUMBER --}}
            <div class="mb-3">
                <label class="form-label">Numero di telefono</label>
                <input name="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror">
                @error('phone_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- GITHUB URL --}}
            <div class="mb-3">
                <label class="form-label">Github/URL</label>
                <input name="github_url" type="url" class="form-control @error('github_url') is-invalid @enderror">
                @error('github_url')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- LINKEDIN URL --}}
            <div class="mb-3">
                <label class="form-label">Linkedin/URL</label>
                <input name="linkedin_url" type="url" class="form-control @error('linkedin_url') is-invalid @enderror">
                @error('linkedin_url')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- PROFILE IMAGE --}}
            <div class="mb-3">
                <label for="profile_image" class="form-label">Immagine di profilo</label>
                <input type="file" class="form-control" name="profile_image" id="profile_image" placeholder=""
                    aria-describedby="fileHelpId">
                    @error('profile_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- CV --}}
            <div class="mb-3">
                <label class="form-label">Curriculum</label>
                <input name="curriculum" type="file" class="form-control @error('curriculum') is-invalid @enderror">
                @error('curriculum')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- PERFORMANCE --}}
            <div class="mb-3">
                <label class="form-label">Perfomance</label>
                <input name="performance" type="text" class="form-control @error('performance') is-invalid @enderror">
                @error('performance')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">CREA</button>

        </form>
    </div>
@endsection
