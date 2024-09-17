<template>
  <tr>
    <td class="relative">
      <ErpButton
        class="absolute"
        :type="csvTarget"
        @click="check"
      />
    </td>
    <td>{{ detail.erpId }}</td>
    <td class="staff_name">
      <ErpLinkButton
        :to="{
          name: 'fareDetail',
          params: { uid: detail.erpId },
          query: { ty: targetYear, tm: targetMonth }
        }"
        :name="detail.name"
      />
    </td>
    <td>{{ detail.twoMonthsAgoCount | numberWithDelimiter }}</td>
    <td>{{ detail.lastMonthCount | numberWithDelimiter }}</td>
    <td>{{ detail.thisMonthCount | numberWithDelimiter }}</td>
    <td>{{ confirmStatus }}</td>
  </tr>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import ErpButton from '@/components/atoms/button/ErpButton.vue'
import ErpLinkButton from '@/components/atoms/button/ErpLinkButton.vue'

export default {
  name: 'ErpFareAllListTableItem',
  components: {
    ErpButton,
    ErpLinkButton
  },
  props: {
    detail: { type: Object, required: true }
  },
  computed: {
    ...mapState({ fareState: 'fare' }),
    ...mapGetters({ csvDownloadList: 'fare/getCsvTarget' }),
    targetMonth () { return this.getMonth(this.detail.targetMonth) },
    targetYear () { return this.getYear(this.detail.targetMonth) },
    csvTarget () {
      if (this.fareState.csv.scope.indexOf(this.detail.erpId) >= 0) {
        return 'red'
      } else if (this.csvDownloadList.indexOf(this.detail.erpId) >= 0) {
        return 'blue'
      }
      return ''
    },
    confirmStatus () {
      return this.$consts.fare.CONFIRM_STATUS_LIST[this.detail.confirmStatus]
    }
  },
  methods: {
    check () { this.$store.commit('fare/scopeCheck', { target: this.detail.erpId }) }
  }
}
</script>

<style scoped lang="scss">
table td {
  padding: 10px 3px;
  text-align: center;
  border: 1px solid #333;
}
.relative {
  position: relative;
}
.absolute {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.staff_name {
  text-decoration: underline;
}
</style>
