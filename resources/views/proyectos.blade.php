@extends('app')

@section('content')
    <!-- {{ $id = app('request')->input('id') }}-->
        sasdas
        <detail  control="1" idperfil="{{Auth::user()->perfil->id}}" auth="{{Auth::id()}}" portfid="{{ $id=app('request')->input('id') }}"></detail>

        <!--  :auth="userid" :portfid="hashid" :idperfil="perfil" -->
@endsection
