<template>
  <ul class="messages">
    <li
      v-for="value in messages"
      :key="value.id"
    >
      <ErpPopUpMessage
        :id="value.id"
        :type="value.type"
        :code="value.code"
        :message="value.message"
        :timeout="value.timeout"
      />
    </li>
  </ul>
</template>

<script>
import { mapGetters } from 'vuex'
import ErpPopUpMessage from '@/components/atoms/popup/ErpPopUpMessage.vue'
export default {
  name: 'ErpPopUpMessages',
  components: {
    ErpPopUpMessage
  },
  computed: {
    ...mapGetters({ getMessages: 'message/getMessages' }),
    messages () { return this.getMessages }
  }
}
</script>

<style scoped lang="scss">
ul {
  margin: 0;
  padding: 0;
}
// li {
//   list-style: none;
// }
.messages {
  z-index:100;
  text-align: center;
  word-wrap: normal;
  position: fixed;
  transform: translate();
  bottom: 10px;
  right: 20px;
  width: 200px;
}
</style>
