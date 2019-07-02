export default {
  methods: {
    goBackToListPage(event = null) {
      if (event) {
        event.preventDefault();
      }
      window.location.href = '/';
    },
  }
};
