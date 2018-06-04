@extends('app')

@section('content')

<perfil user-id="{{Auth::id()}}" perfil="{{Auth::user()->perfil->id}}"></perfil>

@endsection