<template>
  <div class="col-md-6">
    <div class="card">
        <div class="card-header">タスク</div>
        <div class="card-body">
            <ul v-for="todo in todosC" v-bind:key="todosC.id">
                <li>{{ todo.content }}</li>
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
      todosC: "",
    };
  },
  created() {
    this.DblistsGet();
  },
  methods: {
    async DblistsGet() {
      const res = await axios.get("/todos");
      this.todosC = res.data;
    }
  },
};
</script>