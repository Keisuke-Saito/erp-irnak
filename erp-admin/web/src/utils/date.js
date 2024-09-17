export default {
  methods: {
    getNewDate (value) {
      return value === undefined ? new Date() : new Date(value)
    },
    getYear (value) {
      return this.getNewDate(value).getFullYear()
    },
    getMonth (value) {
      return this.getNewDate(value).getMonth() + 1
    },
    getDay (value) {
      return this.getNewDate(value).getDate()
    },
    getDayOfWeek (value) {
      return this.getNewDate(value).getDay()
    },
    getHours (value) {
      return this.getNewDate(value).getHours()
    },
    getMinutes (value) {
      return this.getNewDate(value).getMinutes()
    },
    getSeconds (value) {
      return this.getNewDate(value).getSeconds()
    }
  }
}
