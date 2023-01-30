<template>
    <ul v-for="todo in todos" v-bind:key="todos.id">
      <a :href="'/edit?id=' + todo.id">
        <li>{{ todo.title }}</li>
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
  },
  methods: {
    async DblistsGet() {
      const res = await axios.get("/todos");
      this.todos = res.data;
    }
  },
};
</script>