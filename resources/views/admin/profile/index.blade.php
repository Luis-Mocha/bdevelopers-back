@extends('layouts.app')

@section('content')

<h1>sono la index</h1>
<?php
// dd($profile)?>
@foreach ($profile as $elem)

<div>{{$elem['name']}}</div>
    
@endforeach
@endsection