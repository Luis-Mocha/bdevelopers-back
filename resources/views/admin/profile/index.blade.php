@extends('layouts.app')

@section('content')
    <h1>sono la index</h1>

    @foreach ($profile as $elem)
        <div>{{ $elem['name'] }}</div>

        <div>
            <a class="text-decoration-none" href=" {{ route('admin.edit', $elem) }} " class="my-2 btn btn-primary">Modifica</a>
        </div>
        <form class="m-auto" action="{{ route('admin.destroy', $elem) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">Cancella</button>
        </form>
    @endforeach
@endsection
