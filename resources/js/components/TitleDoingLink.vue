<template>
        <!-- ↓app.blade.phpのコードが取得されてしまう。 -->
        <ul v-for="list in lists">
            <li>{{ list.content }}</li>
        </ul>
        <div>test</div>
</template>

<script>
const url = "/top"

export default {
  props: ["lists_doing"],
  mounted() {
    console.log('listdoing');
  },

  data() {
    return {
      lists: "",
    };
  },

  created() {
    this.DblistsGet();
    console.log('testtest');
  },

  methods: {
    async DblistsGet() {
      const res = await axios.get("/top");
      this.lists = res.data;
      console.log(this.lists);
    }
  },
};
</script>