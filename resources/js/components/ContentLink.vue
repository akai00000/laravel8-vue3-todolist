<template>
  <ul v-for="todo in todos" v-bind:key="todos.id">
    <a :href="'/edit?id=' + todo.id">
      <li>{{ todo.content }}</li>
      test
    </a>
  </ul>
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
  console.log('test');
},
methods: {
  async DblistsGet() {
    const res = await axios.get("/todosC");
    this.todos = res.data;
  }
},
};
</script>