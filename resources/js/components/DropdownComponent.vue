<template>
  <div class="form-group select-input">
    <label :for="id">{{title}}</label>
    <select class="form-control" :id="id" :name="name" :autofocus="autofocus"
            :disabled="hasNoItem" @change="emitSelectedKey" v-model="internalValue">
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
      'disabled',
      'value'
    ],
    data() {
      return {
        internalValue: null
      }
    },
    methods: {
      emitSelectedKey(event) {
        this.$emit('selected-item-changed', parseInt(event.target.value));
        this.$emit('input', parseInt(event.target.value));
      },
      isOptionSelected(optionKey) {
        return this.value && this.value.toString === optionKey.toString;
      }
    },
    watch: {
      value(newVal) {
        this.$emit('selected-item-changed', parseInt(newVal));
        this.$emit('input', parseInt(newVal));
        this.internalValue = newVal;
      }
    },
    computed: {
      optionList() {
        if (this.items && typeof this.items === 'string' && this.items !== '') {
          return JSON.parse(this.items);
        }
        if (this.items && Array.isArray(this.items)) {
          return this.items;
        }
        if (this.$el && this.$el.dataset.list) {
          return JSON.parse(this.$el.dataset.list);
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
