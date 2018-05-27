@extends('app')

@section('content')

<inscripcion user-id="{{Auth::id()}}"></inscripcion>

@endsection