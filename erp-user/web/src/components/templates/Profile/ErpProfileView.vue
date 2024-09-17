<template>
  <div>
    <ErpH1 value="  プロフィール" />
    <ErpSearch
      :profile-history="profileHistory"
      @target="setTarget"
    />
    <ErpProfileDetail
      :profile="profile"
    />
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import ErpH1 from '@/components/atoms/h/ErpH1.vue'
import ErpSearch from '@/components/organisms/profile/ErpSearch.vue'
import ErpProfileDetail from '@/components/molecules/profile/ErpProfileDetail.vue'

export default {
  name: 'ErpProfileView',
  components: {
    ErpH1,
    ErpSearch,
    ErpProfileDetail
  },
  data () {
    return {
      target: 0
    }
  },
  computed: {
    ...mapGetters({ profileHistory: 'auth/getProfileHistory' }),
    profile () {
      // eslint-disable-next-line no-unused-vars
      for (const i in this.profileHistory) {
        const profile = this.profileHistory[i]
        if (Number(i) === this.target) {
          return profile
        }
      }
      return {}
    }
  },
  methods: {
    setTarget (value) {
      this.target = Number(value)
    }
  }
}
</script>

<style scoped lang="scss"></style>
