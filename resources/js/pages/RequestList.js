import RedirectMixin from '../mixins/Redirect';

export default {
  el: '#request-list',
  name: 'RequestList',
  mixins: [RedirectMixin],
  mounted() {
    this.removeFlashElement();
  },
  methods: {
    removeFlashElement() {
      if (document.getElementById('flash-alert-container')) {
        const flashElement = document.getElementById('flash-alert-container');
        setTimeout(() => {
          flashElement.parentNode.removeChild(flashElement);
        }, 5000);
      }
    },
    onDeletionCompleted({data: {id}}) {
      if (id) {
        this.$msgbox({
          title: 'Request Completed',
          message: `Request ${id} is deleted.`,
          type: 'success',
          confirmButtonText: 'OK',
          showClose: false
        }).then(this.goBackToListPage);
      }
    },
    onDeletionFailed(itemId) {
      return ({response: {data: {message}}}) => {
        this.$msgbox({
          title: 'Request Failed',
          message: `Request ${itemId} cannot be deleted. Error: ${message}.`,
          type: 'error',
          showClose: false,
          confirmButtonText: 'OK'
        });
      };
    },
    performDelete(itemId) {
      this.$http.delete('/service-requests/' + itemId)
        .then(this.onDeletionCompleted.bind(this))
        .catch(this.onDeletionFailed(itemId).bind(this));
    },
    deleteItem(event) {
      const message = 'This will permanently delete request ' + event.target.dataset.itemId + '. Continue?';
      const dialogOptions = {
        confirmButtonText: 'Yes',
        confirmButtonClass: 'btn btn-danger',
        cancelButtonText: 'No',
        type: 'warning',
        showClose: false
      };
      this.$confirm(message, 'Warning', dialogOptions)
        .then(this.performDelete.bind(this, event.target.dataset.itemId))
        .catch(() => {});
      event.preventDefault();
    }
  }
};
