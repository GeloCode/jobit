@extends('app')

@section('content')
    <!-- {{ $id = app('request')->input('id') }}-->
        <detail userid="{{Auth::id()}}" hashid="{{ $id=app('request')->input('id') }}"></detail>
@endsection
