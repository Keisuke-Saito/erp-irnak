<template>
  <div class="fare-search">
    <div class="fare-search__form">
      <select
        v-model="targetYear"
        @change="search()"
      >
        <option
          v-for="value in yearsList"
          :key="value"
          :value="value"
        >
          {{ value }}
        </option>
      </select>
      <span>年</span>
      <select
        v-model="targetMonth"
        @change="search()"
      >
        <option
          v-for="value in 12"
          :key="value"
          :value="value"
        >
          {{ value }}
        </option>
      </select>
      <span>月</span>
    </div>
    <ErpLastNext
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
  data () {
    return {
      targetYear: null,
      targetMonth: null
    }
  },
  computed: {
    yearsList () {
      const yearsList = []
      for (let i = 0; i < 21; i++) {
        yearsList.push(this.getYear() - i)
      }
      return yearsList
    }
  },
  created () {
    this.targetYear = Number(this.$route.query.ty ? this.$route.query.ty : this.getYear())
    this.targetMonth = Number(this.$route.query.tm ? this.$route.query.tm : this.getMonth())
    this.search()
  },
  methods: {
    search (value) {
      let year = this.targetYear
      let month = this.targetMonth
      if (value === -1) {
        if (month === 1) {
          year = year - 1
          month = 12
        } else {
          month = month - 1
        }
      } else if (value === 1) {
        if (month === 12) {
          year = year + 1
          month = 1
        } else {
          month = month + 1
        }
      }
      if (year > this.getYear()) {
        return
      }
      if (year === this.getYear() && month > this.getMonth()) {
        return
      }
      if (month > 12 || month < 1) {
        return
      }
      this.targetYear = year
      this.targetMonth = month
      this.$router.push({ name: 'applyFare', query: { ty: this.targetYear, tm: this.targetMonth } })
      this.$emit('fetch', year + '-' + month)
    }
  }
}
</script>

<style scoped lang="scss">
.fare-search {
  position: relative;
  padding-top: 10px;
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
