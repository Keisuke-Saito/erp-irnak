<template>
  <div class="">
    <ErpH1>スタッフ追加画面</ErpH1>
    <ErpCreateForm :store-employee="storeEmployee" />
  </div>
</template>

<script>
import ErpH1 from '@/components/atoms/h/ErpH1.vue'
import ErpCreateForm from '@/components/organisms/employee/ErpCreateForm.vue'

export default {
  name: 'ErpCreateEmployeeView',
  components: {
    ErpH1,
    ErpCreateForm
  },
  methods: {
    async storeEmployee (formdata) {
      await this.$store.dispatch('employee/storeEmployee', formdata).catch(err => this.throwReject(err))
      this.$router.push({ name: 'employee' })
    }
  }
}
</script>

<style scoped lang="scss">
</style>
