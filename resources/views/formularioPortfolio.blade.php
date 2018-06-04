@extends('app') 
@section('content')
    @if(Auth::id())
    <formul></formul>
    @endif
@endsection