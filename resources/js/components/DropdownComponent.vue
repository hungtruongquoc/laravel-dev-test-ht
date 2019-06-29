<template>
  <div class="form-group">
    <slot></slot>
  </div>
</template>

<script>
  export default {
    name: 'DropdownComponent',
    created() {
      console.log(this.$el);
    }
  };
</script>

<style scoped>

</style>
