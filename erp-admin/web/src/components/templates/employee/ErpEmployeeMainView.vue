<template>
  <div class="employee-wrap">
    <ErpLinkButton
      :to="{
        name: 'employee'
      }"
      name="一覧"
    />
    <ErpLinkButton
      :to="{
        name: 'createEmployee'
      }"
      name="追加"
    />
    <Router-view />
  </div>
</template>

<script>
import ErpLinkButton from '@/components/atoms/button/ErpLinkButton.vue'

export default {
  name: 'ErpEmployeeMainView',
  components: {
    ErpLinkButton
  }
}
</script>

<style scoped lang="scss">
.employee-wrap {
  margin-top: 20px;
  .erp-link {
    font-weight: bold;
    padding: 5px;
    text-decoration: underline;
    // border: 1px solid #333;
    & + a {
      margin-left: 5px;
    }
  }
}
</style>
