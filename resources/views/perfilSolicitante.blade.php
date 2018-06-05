@extends('app')

@section('content')

@if(Auth::check())
<perfil-solicitante user-id="{{ $id=app('request')->input('id') }}" perfildesdeempresa="{{ $id=app('request')->input('verenlace') }}"></perfil-solicitante>
@endif
@endsection