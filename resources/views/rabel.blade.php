@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div id="rabellink">
            <rabel-link-component></rabel-link-component>
        </div>    
        <div id="contentlink">
            <content-link-component></content-link-component>
        </div>
        <div id="titlelink">
            <title-link-component></title-link-component>
        </div>
    </div>
<!-- ↓containerdiv -->
</div>
@endsection
