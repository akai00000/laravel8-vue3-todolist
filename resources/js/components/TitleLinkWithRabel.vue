<template>
      <div class="card">
        <div class="card-header">ラベル一覧</div>
        <div class="card-body">
          <ul v-for="rabel in rabels" v-bind:key="rabels.id">
            <button v-on:click="DbListsGet(rabel.rabel_id)">
              {{ rabel.rabel_content }}
            </button>
          </ul>
          {{ test }}
        </div>
    </div>
    
  <div class="card">
      <div class="card-header">タイトル一覧</div>
      <div class="card-body">
          <ul v-for="todo in todos" v-bind:key="todos.id">
            <a>
              {{ todo.title }}
            </a>
          </ul>
      </div>
  </div>
</template>

<script>
let url = "http://localhost:8000/todos?id="

export default {
  data() {
    return {
      todos: "",
      rabels: "",
      rabels_rabel_id: "", 
      test: "",
    };
  },
  created() {
    this.DbRabelsIdGet();
    this.DbRabelsGet();
  },
  methods: {
    //rabel_id入ってきている。OK
    async DbRabelsIdGet() {
      const res1 = await axios.get("/rabelsid");
      this.rabels_rabel_id = res1.data;
    },
    // 。
    async DbListsGet(id) {
      let id_url = url + this.rabels_rabel_id[id - 1].rabel_id
      const res2 = await axios.get(id_url);
      this.todos = res2.data[0];
    },
    // ラベルの中身取れている。OK
    async DbRabelsGet() {
      const res3 = await axios.get("/rabels");
      this.rabels = res3.data;
    }
  },
};


</script>