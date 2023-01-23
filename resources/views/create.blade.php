@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    タスクの新規作成
                </div>
                <div class="card-body">
                    @if(count($errors) > 0)
                    <div>
                        <ul>
                            @foreach($errors->all as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method='POST' action="/store">
                        @csrf
                        <!-- ユーザーIDのhidden送信 -->
                        <input type='hidden' name='user_id' value="1">
                        <input type='hidden' name='status' value ="1">
                        <!-- タイトル -->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">・タイトル</label>
                            <input type="text" class="form-control" name="title" placeholder="タイトルを入れてください">
                        </div>
                        <!-- ラベル -->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">・ラベル</label>
                            <input type="text" class="form-control" name = "rabel" id="rabel" placeholder="ラベルを入れてください">
                        </div>
                        <!-- 優先度 -->
                        <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">・優先度</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="priority" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">高</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="priority" id="inlineRadio2" value="2">
                                <label class="form-check-label" for="inlineRadio2">中</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="priority" id="inlineRadio3" value="3">
                                <label class="form-check-label" for="inlineRadio3">低</label>
                            </div>
                        </div>
                        <!-- 内容 -->
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">・タスク</label>
                            <textarea class="form-control" name = "content" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <!-- 締切日 -->
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">・締切日</label><br>
                            <input name="deadline" type="date">
                        </div>
                        <!-- 送信ボタン -->
                        <button type='submit' class="btn btn-primary btn-lg">作成</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
