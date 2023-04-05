<template>
  <div class="card">
    <div class="card-header">タスク</div>
    <div class="card-body">
      <form method='POST' action="/edit">
        <!-- @csrf -->
        <!-- ユーザーIDのhidden送信 -->
        <input type='hidden' name='user_id' v-model="todos.id">
        <!-- タイトル -->
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">・タイトル</label>
            <input type="text" class="form-control" name="title" v-model="todos.title">
        </div>
        <!-- ラベル -->
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">・ラベル</label>
            <input type="text" class="form-control" name = "rabel" id="rabel" v-model="todos.rabel">
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
            <textarea class="form-control" name = "content" id="exampleFormControlTextarea1" rows="3">{{ todos.content }}</textarea>
        </div>
        <!-- 締切日 -->
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">・締切日</label><br>
            <input name="deadline" type="date" v-model="todos.deadline">
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      todos: "",
    };
  },
  created() {
    this.DblistsGet();
  },
  methods: {
    async DblistsGet() {
      const res = await axios.get("/todos");
      this.todos = res.data[1];
      const radioButton1 = document.getElementById("inlineRadio1")
      const radioButton2 = document.getElementById("inlineRadio2")
      const radioButton3 = document.getElementById("inlineRadio3")
      if(this.todos.priority == 1)
      {
        radioButton1.checked = true;
      }
      if(this.todos.priority == 2)
      {
        radioButton2.checked = true;
      }
      if(this.todos.priority == 3)
      {
        radioButton3.checked = true;
      }
    }
  },
};
</script>