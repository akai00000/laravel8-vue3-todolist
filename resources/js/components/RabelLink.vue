<template>
  <div class="col-md-2">
    <div class="card">
        <div class="card-header">ラベル一覧</div>
        <div class="card-body">
          <ul v-for="todo in todos" v-bind:key="todos.id">
            <a :href="'/edit?id=' + todo.id">
              <li>{{ todo.rabel_content }}</li>
            </a>
          </ul>
        </div>
    </div>
  </div>
</template>

<script>
const url = "/top"
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
    const res = await axios.get("/rabels");
    this.todos = res.data;
  }
},
};
</script>