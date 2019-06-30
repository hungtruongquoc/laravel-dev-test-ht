<template>
  <div class="form-group">
    <label :for="id">{{title}}</label>
    <select class="form-control" :id="id" :name="name" :autofocus="autofocus"
            :disabled="disabled" @change="emitSelectedKey">
      <option v-for="item in optionList" :value="item.id" :key="item.id">
        <slot name="item-title" :item="item"></slot>
      </option>
    </select>
  </div>
</template>

<script>
  export default {
    name: 'DropdownComponent',
    props: [
      'items',
      'id',
      'name',
      'title',
      'autofocus',
      'disabled'
    ],
    data() {
      return {
        optionList: null,
        modelList: null
      }
    },
    created() {
      if(this.items && this.items !== '') {
        this.optionList = JSON.parse(this.items);
      }
    },
    methods: {
      emitSelectedKey(event) {
        this.$emit('selected-item-changed', event.target.value);
      }
    }
  };
</script>

<style scoped>

</style>
