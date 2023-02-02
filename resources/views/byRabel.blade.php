@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">   
        <div class="col-md-9" id="contentlink">
            <input type='hidden' v-bind:value="{{ $todos_with_rabel }}">
            <content-link-component></content-link-component>
        </div>
        <div class="col-md-3" id="titlelink">
            <input type='hidden' v-bind:value="{{ $title_with_rabel }}">
            <title-link-component></title-link-component>
        </div>
    </div>
<!-- ↓containerdiv -->
</div>
@endsection
