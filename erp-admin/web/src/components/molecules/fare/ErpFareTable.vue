<template>
  <div class="m-fare-table">
    <table class="fare-table">
      <tr>
        <th
          v-for="(th, key, index) in thList"
          :key="index"
        >
          {{ th }}
        </th>
      </tr>
      <slot />
    </table>
  </div>
</template>

<script>
export default {
  name: 'ErpFareTable',
  props: {
    thList: { type: Array, required: true }
  }
}
</script>

<style scoped lang="scss">
table {
  width: 1000px;
  border-collapse: collapse;
  border-spacing: 0;
}
table tr:nth-child(odd) {
  background-color: #EEEEEE
}
table th {
  border: 1px solid #333;
  color:#225588;
  background: #EEE;
  box-shadow: 0px 1px 1px rgba(255,255,255,0.3) inset;
  padding: 10px 0;
  text-align: center;
  position: relative;
  // 対象
  &:first-child {
    width: 80px;
  }
  // スタッフ名
  &:nth-child(2),
  &:nth-child(3) {
    width: 500px;
  }
  // 金額
  &:nth-child(4),
  &:nth-child(5),
  &:nth-child(6) {
    width: 300px;
  }
  // 確定
  &:last-child {
    width: 250px;
  }
}
// table td {
//   border: 1px solid #eee;
//   padding: 0 5px;
// }
</style>
