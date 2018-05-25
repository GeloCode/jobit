@extends('app')

@section('content')
<h2>ESTE ES TU ID {{Auth::id()}}</h2>
<oferta user-id="{{Auth::id()}}"></oferta>

@endsection