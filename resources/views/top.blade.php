@extends('layouts.app')

@section('content')
    <div id="top">
        <component :csrf="{{json_encode(csrf_token())}}"></component>
    </div>
@endsection
