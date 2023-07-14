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
            <div>
                <h2>Immagine di profilo:</h2>
                <img src="{{ asset('storage/' . $elem->profile_image) }}" alt="">
            </div>
            <div>
                <h2>Curriculum:</h2>
                {{-- <img src="{{asset('storage/' . $elem->curriculum)}}" alt=""> --}}
            </div>
            <div>
                <h2>Performance:</h2>
                <h3 class="mb-3 text-uppercase">{{ $elem['performance'] }}</h3>
            </div>
            <div>
                <a class="text-decoration-none" href=" {{ route('admin.edit', $elem) }} "
                    class="my-2 btn btn-primary">Modifica</a>
            </div>
            <form class="m-auto" action="{{ route('admin.destroy', $elem) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Cancella</button>
            </form>
        @endforeach
    </div>
@endsection
