<template>
<div class="row justify-content-center">
<!-- ラベル -->
<div class="col-md-3">
    <div class="card">
        <div class="card-header">ラベル一覧</div>
        <div class="card-body">
            <ul v-for="rabel in rabels" v-bind:key="rabels.id">
            <button v-on:click="DbTitlesGets(rabel.rabel_id)">
                {{ rabel.rabel_content }}
            </button>
            </ul>
        </div>
    </div>
</div>

<!-- タスク内容 -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header">タスク</div>
        <div class="card-body">
        <form method='POST' action="/top">
            <input type="hidden" name="_token" :value="csrf">
            <!-- ユーザーIDのhidden送信 -->
            <input type='hidden' name='id' v-model="todos_content.id">
            <!-- タイトル -->
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">・タイトル</label>
                <input type="text" class="form-control" name="title" @input="change" v-model="todos_content.title">
            </div>
            <!-- ラベル -->
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">・ラベル</label>
                <input type="text" class="form-control" name = "rabel" id="rabel" v-model="todos_content.rabel">
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
                <textarea class="form-control" name = "content" id="exampleFormControlTextarea1" rows="3">{{ todos_content.content }}</textarea>
            </div>
            <!-- 締切日 -->
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">・締切日</label><br>
                <input name="deadline" type="date" v-model="todos_content.deadline">
            </div>
            <!-- 送信ボタン -->
            <button type="submit" class="btn btn-primary btn-lg" id="update" disabled>更新</button> <!-- v-on:click="update" -->
        </form>
        </div>
    </div>
</div>

<!-- タイトル -->
<div class="col-md-3">
    <div class="card">
        <div class="card-header">タイトル一覧</div>
        <div class="card-body">
            <ul v-for="todo in todos" v-bind:key="todos.id">
            <button v-on:click="DbContentsGet(todo.id)">
                {{ todo.title }}
            </button>
            </ul>
        </div>
    </div>
</div>
</div>
</template>

<script>
let url = "http://localhost:8000/todos?id="

export default {
                            data() {
                                return {
                                    todos: "",//set object(arrayarray)
                                    todos_titles: "",//set object(arrayarray)
                                    todos_content: "",//set object(arrayarray)
                                    rabels: "",//set object(arrayarray)
                                    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),


                                };
                            },
created() {
  this.CrtDbRabelsIdGet();
  this.CrtDbRabelsGet();
  this.DbTitlesGets();
},
methods: {
  //DBのrabelsからrabel_idカラムの値を取得するメソッド
  async CrtDbRabelsIdGet() {
    const res_rabelsid = await axios.get("/rabelsid");
    this.rabels_table_rabel_id = res_rabelsid.data;
  },
  // DBのrabelsからrabel_contentカラムを取得するメソッド
  async CrtDbRabelsGet() {
    const res_rabels = await axios.get("/rabels");
    this.rabels = res_rabels.data;
  },
  //this "id" is the getting rabel_id from "rabels table".
  //this "rabel_id" is getting rabel_id from "todos table".
  //rabel_idが一致するtodosテーブルのcontentsを取得するメソッド
  async DbContentsGet(id) {
      if(!id) {
        const res_todos = await axios.get("/todos")
        this.todos_content = res_todos.data[2]
    } else {
        const res_todos = await axios.get("/todos" + '?id=' + id)
        this.todos_content = res_todos.data[3]
        // document.getElementById("update").disabled = null
    }
        const radioButton1 = document.getElementById("inlineRadio1")
        const radioButton2 = document.getElementById("inlineRadio2")
        const radioButton3 = document.getElementById("inlineRadio3")
        if(this.todos_content.priority == 1) {
            radioButton1.checked = true;
        }
        if(this.todos_content.priority == 2) {
            radioButton2.checked = true;
        }
        if(this.todos_content.priority == 3) {
            radioButton3.checked = true;
        }
  },
  async DbTitlesGets(id) {
    if(!id) {
        const res_todos = await axios.get('/todos');
        this.todos = res_todos.data[0];
    } else {
        const radioButton1 = document.getElementById("inlineRadio1")
        const radioButton2 = document.getElementById("inlineRadio2")
        const radioButton3 = document.getElementById("inlineRadio3")
        radioButton1.checked = false
        radioButton2.checked = false
        radioButton3.checked = false
        this.todos_content.title = ""
        this.todos_content.rabel = ""
        this.todos_content.content = ""
        this.todos_content.deadline = ""
        let id_url = url + id
        // res2 is arr([id, title, content, deadline, ....] matched by this id)
        const res2 = await axios.get(id_url);
        this.todos = res2.data[1];
    }
  },
  async update() {
    const res_rabels = await axios.post("/update", { 
            id : this.todos_content.id,
            title : this.todos_content.title,
            rabel: this.todos_content.rabel,
            content: this.todos_content.content,
            priority: this.todos_content.priority,
            deadline: this.todos_content.deadline,
        },);
  },
//   foo() {
//   document.getElementById("update").disabled = null
//   },
  change() {
    document.getElementById("update").disabled = null
    }
},
};
</script>       