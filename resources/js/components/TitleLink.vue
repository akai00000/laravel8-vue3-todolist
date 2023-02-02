<template>
  <div class="card">
      <div class="card-header">タイトル一覧</div>
      <div class="card-body">
          <ul v-for="todo in todosT" v-bind:key="todosT.id">
            <a :href="'/edit?id=' + todo.id">
              {{ todo.title }}
            </a>
          </ul>
      </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      todosT: "",
    };
  },
  created() {
    this.DblistsGet();
  },
  methods: {
    async DblistsGet() {
      const res = await axios.get("/todos");
      this.todosT = res.data[0];
    }
  },
};
</script>