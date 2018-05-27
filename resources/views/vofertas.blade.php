@extends('app')

@section('content')

<oferta-solicitante user-id="{{Auth::id()}}"></oferta-solicitante>

@endsection