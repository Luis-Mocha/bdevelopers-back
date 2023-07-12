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
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input name="name" type="text" class="form-control @error('title') is-invalid @enderror">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Cognome</label>
            <input name="surname" type="text" class="form-control @error('subtitle') is-invalid @enderror">
            @error('surname')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="mb-3">
            <label class="form-label">Description</label>
            <input name="description" type="text" class="form-control @error('description') is-invalid @enderror">
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div> --}}

        {{-- INPUT FILE --}}

        {{-- <div class="mb-3">
          <label for="project-cover-image" class="form-label">Project Image</label>
          <input type="file" class="form-control" name="cover_image" id="project-cover-image" placeholder="" aria-describedby="fileHelpId">
          <div id="fileHelpId" class="form-text">Help text</div>
        </div> --}}

        <button type="submit" class="btn btn-primary">CREA</button>
    
      </form>
</div>

@endsection