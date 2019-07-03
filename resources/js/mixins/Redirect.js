export default {
  methods: {
    goBackToListPage(event = null) {
      if (event && typeof event === 'object') {
        event.preventDefault();
      }
      window.location.href = '/';
    },
  }
};
