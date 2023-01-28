@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-2">
            <div class="card">
                <div class="card-header">ラベル一覧</div>
                <div class="card-body">
                    <div class="rabel-block">
                        <div class="d-flex flex-column">
                <!-- rabelvue -->
                        </div>
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

            <div id="vuedata">
                <vuedata-component></vuedata-component>
            </div>
                <!-- contentvue -->
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
                    <div class="title-block">
                        <div class="d-flex flex-column">
                            <div id="titledoing">
                                <titledoing-component></titledoing-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ mix('js/app.js') }}"></script>

<!-- ↓containerdiv -->
</div>



@endsection
