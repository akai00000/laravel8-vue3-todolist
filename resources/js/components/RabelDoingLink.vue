<template>
        <ul v-for="rabel in lists">
            <a v-bind:href="`/edit/?id=${rabel.id}`"><li>{{ rabel.rabel }}</li></a>
        </ul>
</template>

<script>
const url = "/top"

export default {
  props: ["lists"],
  mounted() {
    console.log('test')
  },
};
</script>