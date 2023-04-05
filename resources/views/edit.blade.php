@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-2">
            <div class="card">
                <div class="card-header">ラベル一覧</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="rabel-block">
                            <div class="d-flex flex-column" style="height: 200px;">
                            @foreach($rabels as $rabel)
                                    <div class="flex-fill border">
                                        <a href = "">{{ $rabel['rabel_content'] }}</a>
                                    </div>
                            @endforeach
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

                    <form method='POST' action="/edit">
                        @csrf
                        <!-- todo_id hidden -->
                        <input type="hidden" name="id" value = "{{ $todo->id }}">
                        <!-- タイトル -->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">・タイトル</label>
                            <input type="text" class="form-control" name="title" value = "{{ $todo->title }}">
                        </div>
                        <!-- ラベル -->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">・ラベル</label>
                            <input type="text" class="form-control" name = "rabel" value = "{{ $todo->rabel }}">
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
                            <textarea class="form-control" name = "content" id="exampleFormControlTextarea1" rows="3">{{ $todo->content }}</textarea>
                        </div>
                        <!-- 締切日 -->
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">・締切日</label><br>
                            <input name="deadline" type="date" value = "{{ $todo->deadline }}">
                        </div>
                        <!-- 送信ボタン -->
                        <button type='submit' class="btn btn-primary btn-lg">更新</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">

                <div class="card-header">締切順</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="title-block">
                        <div class="d-flex flex-column">
                            @foreach($titles as $title)
                            <div class="flex-fill border">
                                <a href = "">{{ $title['title'] }}</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>
@endsection
