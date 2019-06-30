@extends('layouts.main')
@section('content')
  <div class="container" id="app">
    <form method="POST" action="{{route('store')}}">
      <app-select title="Make" :id="'vehicle-make'" :name="'vehicle-make'" v-model="selectedMake"
                  @selected-item-changed="loadModels" items="{{$makes}}" :autofocus="true">
        <template v-slot:item-title="slotProps">
          @{{ slotProps.item.title }}
        </template>
      </app-select>
      <app-select title="Model" :id="'vehicle-model'" :name="'vehicle-model'" :items="modelList"
                  v-model="selectedModel">
        <template v-slot:item-title="slotProps">
          @{{ slotProps.item.title }}
        </template>
      </app-select>
      <div class="form-group">
        <label for="owner-name" class="input-required">Owner's Name</label>
        <input type="text" class="form-control" id="owner-name" placeholder="Please provide your full name"
               name="owner-name" maxlength="200">
      </div>
      <div class="form-group">
        <label for="owner-email" class="input-required">Email Address</label>
        <input type="email" class="form-control" id="owner-email" aria-describedby="emailHelp"
               placeholder="Enter email" name="owner-email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="owner-phone">Phone</label>
        <input type="email" class="form-control" id="owner-phone" placeholder="Enter phone number" name="owner-phone">
      </div>
      <button type="submit" class="btn btn-primary" disabled>Submit</button>
    </form>
  </div>
@endsection
