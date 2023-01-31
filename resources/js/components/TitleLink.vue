<template>
<div class="col-md-4">
  <div class="card">
      <div class="card-header">タイトル</div>
      <div class="card-body">
          <ul v-for="todo in todosT" v-bind:key="todosT.id">
            <a :href="'/edit?id=' + todo.id">
              <li>{{ todo.title }}</li>
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
      todosT: "",
    };
  },
  created() {
    this.DblistsGet();
  },
  methods: {
    async DblistsGet() {
      const res = await axios.get("/todos");
      this.todosT = res.data;
    }
  },
};
</script>