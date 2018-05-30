@extends('app')

@section('content')

<inscripcion-empresa user-id="{{Auth::id()}}"></inscripcion-empresa>

@endsection