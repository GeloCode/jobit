@extends('app')

@section('content')
    <!-- {{ $id = app('request')->input('id') }}-->
        <detail  perfil="{{Auth::user()->perfil->id}}" userid="{{Auth::id()}}" hashid="{{ $id=app('request')->input('id') }}"></detail>
@endsection
