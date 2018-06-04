@extends('app')

@section('content')

@if(Auth::check())
<perfil user-id="{{Auth::id()}}" isEmpresa="{{Auth::user()->isEmpresa()}}"></perfil>
@endif
@endsection