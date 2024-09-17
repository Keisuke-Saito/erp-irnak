<template>
  <div class="search">
    <div class="search__form">
      <span>更新履歴</span>
      <select
        v-model="target"
        @change="search()"
      >
        <option
          v-for="value, index in profileHistory"
          :key="value.uuid"
          :value="index"
        >
          {{ value.createdAt }}
        </option>
      </select>
    </div>
    <ErpLastNext
      type="profile"
      @search="search"
    />
  </div>
</template>

<script>
import ErpLastNext from '@/components/molecules/common/ErpLastNext.vue'

export default {
  name: 'ErpSearch',
  components: {
    ErpLastNext
  },
  props: {
    profileHistory: { type: Array, required: true }
  },
  data () {
    return {
      target: 0
    }
  },
  methods: {
    search (value) {
      let target = this.target
      if (value === -1) {
        target = target - value
        if (target >= this.profileHistory.length) return
      } else if (value === 1) {
        target = target - value
        if (target < 0) return
      }
      this.target = Number(target)
      this.$emit('target', this.target)
    }
  }
}
</script>

<style scoped lang="scss">
.search {
  margin-top: 50px;
  position: relative;
  &__form {
    margin-left: 90px;
  }
}
select {
  height: 38px;
  font-size: 15px;
  color: #333;
  cursor: pointer;
}
</style>
