<template>
  <span :class="'text-' + textColor">
    <font-awesome-icon :icon="icon"></font-awesome-icon> {{status}}
  </span>
</template>

<script>
  export default {
    name: 'RequestStatus',
    props: [
      'status'
    ],
    computed: {
      textColor() {
        switch(this.status.toLocaleLowerCase()) {
          case 'ready for pickup':
          case 'new':
            return 'info';
          case 'waiting on parts':
            return 'warning';
        }
        return 'success';
      },
      icon() {
        if (this.status.toLocaleLowerCase() === 'closed') {
          return 'check-circle';
        }
        return null;
      }
    }
  };
</script>

<style scoped>

</style>
