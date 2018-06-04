@extends('app')

@section('content')

<perfil empresaornot="{{!Auth::user()->isEmpresa()}}" user-id="{{Auth::id()}}" perfil="{{Auth::user()->perfil->id}}"></perfil>

@endsection