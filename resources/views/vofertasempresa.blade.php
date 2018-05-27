@extends('app')

@section('content')

<oferta-empresa user-id="{{Auth::id()}}"></oferta-empresa>

@endsection