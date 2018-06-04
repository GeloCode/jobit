@extends('app')

@section('content')
    <detail  control="1" auth="{{Auth::id()}}" portfid="{{ $id=app('request')->input('id') }}"></detail>
@endsection
