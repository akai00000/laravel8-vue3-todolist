@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">
                <div class="card-header">タスク</div>

                <div class="card-body">
                  vue表示サンプル
                </div>
            </div>

            <div id="vuedata">
                <test-component></test-component>
            </div>

            <script src="{{ mix('js/app.js') }}"></script>

        </div>

    </div>
<!-- ↓containerdiv -->
</div>



@endsection
