@extends('app')

@section('content')

<inscripcion-empresa verenlace="1" user-id="{{Auth::id()}}" oferta-id="{{app('request')->input('ofertaId')}}"></inscripcion-empresa>

@endsection