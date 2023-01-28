<template>
  <div>
    <div class="m-3">
      <div>税込価格：{{ totalValue }}</div>
    </div>
    <input type="text" class="p-1 border ring-1 rounded-md border-color-300" v-model="price">
  </div>
</template>

<script>
export default {
  data() {
    return {
      price: 100,
      tax: 1.1,
      totalValue: 100,
    }
  },

  watch: {
    price (new_data) {
      console.log('test')
        this.totalValue = Math.round(new_data * this.tax)   
    }
  },
};
</script>