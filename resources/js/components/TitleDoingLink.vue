<template>
<!-- ↓app.blade.phpのコードが取得されてしまう。 -->
<!-- 上記問題解決.2023/01/27 -->
        <ul v-for="list in lists">
          <a :href="'/edit?id=' + list.id">
            <li>{{ list.title }}</li>
          </a>
        </ul>
</template>

<script>
const url = "/top"

export default {
  props: ["lists_doing"],
  mounted() {
    console.log('lists_doing');
  },

  data() {
    return {
      lists: "",
    };
  },

  created() {
    this.DblistsGet();
  },

  methods: {
    async DblistsGet() {
      const res = await axios.get("/lists");
      this.lists = res.data;
      console.log(this.lists);
    }
  },
};
</script>