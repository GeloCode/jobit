@extends('app')

@section('content')

<inscripcion-solicitante user-id="{{Auth::id()}}"></inscripcion-solicitante>

@endsection