<template>
  <div>
    <div class="m-3">
      <div>aaa税込価格：{{ totalValue }}</div>
    </div>
    <button v-on:click="test()">button</button>
    <input type="text" class="p-1 border ring-1 rounded-md border-color-300" v-model="price">
  </div>
</template>

<script>
export default {
  data() {
    return {
      price: 100,
      tax: 1.1,
      totalValue: 1000,
    }
  },

  // created() {
  //   console.log('sample');
  // },

  // methods: {
  //   test() {
  //     console.log('test')
  //       // priceの値が変わるとここの処理が走る
  //       // ここで税込価格の処理をする
  //       // new_dataは新しく入力された値
  //       // old_dataは古い値
  //       this.totalValue = Math.round(new_data * this.tax);
  //   }
  // },

  watch: {
    price (new_data) {
      console.log('test')
        // priceの値が変わるとここの処理が走る
        // ここで税込価格の処理をする
        // new_dataは新しく入力された値
        // old_dataは古い値
        this.totalValue = Math.round(new_data * this.tax)   
    }
  },
};
</script>