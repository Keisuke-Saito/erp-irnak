<template>
  <table>
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
</template>

<script>

export default {
  name: 'ErpTable',
  props: {
    thList: { type: Array, required: true }
  }
}
</script>

<style scoped lang="scss">
table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
}

table th {
  padding: 5px 0;
  text-align: center;
}

table tr:nth-child(odd) {
  background-color: #EEEEEE
}

table th {
  border: 1px solid #333;
  color: #225588;
  background: #EEE;
  box-shadow: 0px 1px 1px rgba(255, 255, 255, 0.3) inset;
  padding: 5px 0;
  text-align: center;
  position: relative;
}
.fare-detail-table {
  width: 140%;
}
</style>
