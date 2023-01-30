@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-2">
            <div class="card">
                <div class="card-header">ラベル一覧</div>
                <div class="card-body">
                    <div id="rabellink">
                        <rabel-link-component></rabel-link-component>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">タスク</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id="contentlink">
                        <content-link-component></content-link-component>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">タイトル</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div id="titlelink">
                        <title-link-component></title-link-component>
                    </div>
                </div>
            </div>
        </div>

    </div>


<!-- ↓containerdiv -->
</div>



@endsection
