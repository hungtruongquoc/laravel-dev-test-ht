<template>
  <div class="form-group">
    <label :for="id">{{title}}</label>
    <select class="form-control" :id="id" :name="name" :autofocus="autofocus"
            :disabled="hasNoItem" @change="emitSelectedKey">
      <option v-for="item in optionList" :value="item.id" :key="item.id"
              :selected="isOptionSelected(item.id)">
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
      'disabled',
      'value'
    ],
    methods: {
      emitSelectedKey(event) {
        this.$emit('selected-item-changed', event.target.value);
        this.$emit('input', parseInt(event.target.value));
      },
      isOptionSelected(optionKey) {
        return this.value && this.value.toString === optionKey;
      }
    },
    computed: {
      optionList() {
        if (this.items) {
          if (typeof this.items === 'string') {
            return JSON.parse(this.items);
          }
          return [].concat(this.items);
        }
        return null;
      },
      hasNoItem() {
        return !this.optionList || this.optionList.length < 1;
      }
    }
  };
</script>

<style scoped>

</style>
