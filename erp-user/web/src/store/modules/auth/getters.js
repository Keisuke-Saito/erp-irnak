export default {
  getProfileLatest (state) {
    const profile = state.profile[0]
    return (profile === undefined) ? {} : profile
  },
  getProfileHistory (state) { return state.profile }
}
