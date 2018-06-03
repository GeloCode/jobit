@extends('app')

@section('content')

<inscripcion-empresa user-id="{{Auth::id()}}" oferta-id="{{app('request')->input('ofertaId')}}"></inscripcion-empresa>

@endsection