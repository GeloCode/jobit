@extends('app')

@section('content')
    <!-- {{ $id = app('request')->input('id') }}-->
    asdasdasdasdasdas
        <detail userid="{{Auth::id()}}" hashid="{{ $id=app('request')->input('id') }}"></detail>
@endsection
