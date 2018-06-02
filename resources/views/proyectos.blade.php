@extends('app')

@section('content')
    <!-- {{ $id = app('request')->input('id') }}-->
        <detail hashid="{{ $id=app('request')->input('id') }}"></detail>
@endsection
