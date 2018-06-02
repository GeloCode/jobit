@extends('app')

@section('content')

<oferta-solicitante user-id="{{Auth::id()}}" word="{{ app('request')->input('word') }}" 
    provincia-id="{{app('request')->input('provinciaId')}}"></oferta-solicitante>

@endsection