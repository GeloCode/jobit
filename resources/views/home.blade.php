@extends('layouts.app')

@section('content')
<div class="container">
<perfil user-id="{{Auth::id()}}"></perfil>
</div>
@endsection
