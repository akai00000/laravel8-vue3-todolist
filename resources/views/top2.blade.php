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
                <div id="taxPrice">
                    <taxprice-link-component></taxprice-link-component>
                </div>
            </div>

        </div>

    </div>
<!-- ↓containerdiv -->
</div>



@endsection
