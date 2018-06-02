@extends('app') 
@section('content')
    <project idproyecto="{{ $id=app('request')->input('id') }}"></project>
@endsection
