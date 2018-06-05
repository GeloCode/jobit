@extends('app')

@section('content')

@if(Auth::check())
<perfil user-id="{{Auth::id()}}"></perfil>
@endif
@endsection