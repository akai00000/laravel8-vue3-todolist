<template>
  <div>
    <ul v-for="content in lists">{{ content.content }}</ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      content: "",
    };
  },

  created() {
    this.contentGet();
  },

  methods: {
    async contentGet() {
      const listsdata = await axios.get("/top");
      this.lists = listsdata.data;
    },
  },
};
</script>