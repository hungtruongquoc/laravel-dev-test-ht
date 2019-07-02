<template>
  <div class="form-group select-input">
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
    mounted() {
      console.log(this.$el.dataset);
    },
    methods: {
      emitSelectedKey(event) {
        this.$emit('selected-item-changed', event.target.value);
        this.$emit('input', parseInt(event.target.value));
      },
      isOptionSelected(optionKey) {
        if (this.value && this.value.toString === optionKey.toString) {
          this.$emit('selected-item-changed', optionKey);
          return true;
        }
        return false;
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
