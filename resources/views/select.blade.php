<app-select inline-template>
  <label for="{{$id}}">{{$title}}</label>
  <select class="form-control" id="{{$id}}" name="{{$name}}" @if(isset($disabled) && $disabled) disabled @endif
    @if(isset($autofocus) && $autofocus) autofocus @endif
  >
   @foreach($items as $item)
     <option value="{{$item->id}}">{{$item->title}}</option>
    @endforeach
  </select>
</app-select>
