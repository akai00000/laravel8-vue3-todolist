<template>
    <div class="card">
        <div class="card-header">ラベル一覧</div>
        <div class="card-body">
          <ul v-for="todo in todos" v-bind:key="todos.id">
            <a :href="'/byRabel?id=' + todo.rabel_id">
              {{ todo.rabel_content }}
            </a>
          </ul>
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