@extends('app')

@section('content')

@if(Auth::check())
<perfil-solicitante user-id="{{ $id=app('request')->input('id') }}"></perfil-solicitante>
@endif
@endsection