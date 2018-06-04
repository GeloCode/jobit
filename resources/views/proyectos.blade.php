@extends('app')

@section('content')
    <!-- {{ $id = app('request')->input('id') }}-->
        @if(Auth::check())
        <detail  control="1" idperfil="{{Auth::user()->perfil->id}}" auth="{{Auth::id()}}" portfid="{{ $id=app('request')->input('id') }}"></detail>
        @else
        <detail control="1" auth="{{Auth::id()}}" portfid="{{ $id=app('request')->input('id') }}"></detail>
        @endif
        <!--  :auth="userid" :portfid="hashid" :idperfil="perfil" -->
@endsection
