@extends('app') 
@section('content')
    @if(Auth::id())
    <formul user-id="{{Auth::id()}}"></formul>
    @endif
@endsection