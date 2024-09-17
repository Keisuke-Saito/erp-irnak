<template>
  <nav class="navigation">
    <div class="title">
      <h1 :class="{ active: $route.path === '/' }">
        <router-link
          :to="{ name: 'top' }"
          class="title-link"
        >
          イルナック
        </router-link>
      </h1>
    </div>
    <div
      class="name"
      @mouseover="mouseOverAction"
      @mouseleave="mouseLeaveAction"
    >
      <p>{{ employeeName }}</p>
      <div
        v-if="hoverFlag"
        class="actions"
      >
        <ErpButton
          type="logout"
          @click="logout"
        >
          ログアウト
        </ErpButton>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'
import ErpButton from '@/components/atoms/button/ErpButton.vue'

export default {
  name: 'ErpNavigation',
  components: {
    ErpButton
  },
  data: function () {
    return {
      hoverFlag: false
    }
  },
  computed: {
    ...mapGetters({ profileLatest: 'auth/getProfileLatest' }),
    employeeName () {
      const name = this.profileLatest.name
      return (name === undefined) ? '' : name
    }
  },
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')
      await this.$router.push({ name: 'login' })
    },
    mouseOverAction (index) {
      this.hoverFlag = true
      this.hoverIndex = index
    },
    mouseLeaveAction () {
      this.hoverFlag = false
    }
  }
}
</script>

<style scoped lang="scss">
.navigation {
  display: flex;
  width: 100%;
  height:100%;
  background-color: #1E488D;
}
.title {
  flex: 1;
}
.title h1{
  margin: 0;
  /* width:160px; */
  height:100%;
  color: #fff;
  letter-spacing:1px;
  text-align:left;
  line-height: 60px;
  margin-left: 20px;
}

.title-link {
  text-decoration: none;
  color: #fff;
}

.name {
  color: #fff;
  font-weight: bold;
  text-shadow: 0 0 10px rgba(0,0,0,0.3);
  position: relative;
  margin-right: 20px;
  cursor: pointer;
}
.actions {
  /* margin: 5px 20px; */
  padding: 5px;
  width: 150px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  bottom: -35px;
  right: -5px;
}
</style>
