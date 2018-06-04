@extends('app')

@section('content')

<perfil user-id="{{Auth::id()}}"></perfil>

@endsection