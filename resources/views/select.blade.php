<app-select title="{{$title}}" :id="'{{$id}}'" :name="'{{$name}}'"
            @selected-item-changed="loadModels"
            items="{{$items}}" @if(isset($disabled)) :disabled="{{$disabled}}" @endif
            @if(isset($autofocus)) :autofocus="{{$autofocus}}" @endif>
  <template v-slot:item-title="slotProps">
    @{{ slotProps.item.title }}
  </template>
</app-select>
