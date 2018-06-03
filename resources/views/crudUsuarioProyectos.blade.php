@extends('app') 
@section('content')
                <dash hashid="{{ $id=app('request')->input('id') }}"></dash>
@endsection