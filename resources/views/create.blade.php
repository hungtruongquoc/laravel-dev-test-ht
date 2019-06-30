@extends('layouts.main')
@section('content')
  <div class="container" id="app">
    @if($errors->any()) <div class="alert alert-danger">Please correct invalid inputs</div> @endif
    <form method="POST" action="{{route('store')}}" @submit="checkFormValidity">
      @csrf
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
        <input type="hidden" value="{{old('owner-name')}}" id="previous-owner-name">
        <input type="text" class="form-control @error('owner-name') is-invalid @enderror" id="owner-name"
               placeholder="Please provide your full name"
               name="owner-name" maxlength="200" v-model="ownerName">
        @error('owner-name')
          <span class="invalid-feedback">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="owner-email" class="input-required">Email Address</label>
        <input type="hidden" value="{{old('owner-email')}}" id="previous-owner-email">
        <input type="email" class="form-control @error('owner-email') is-invalid @enderror" id="owner-email"
               aria-describedby="emailHelp"
               placeholder="Enter email" name="owner-email" v-model="ownerEmail">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        @error('owner-email')
          <span class="invalid-feedback">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="owner-phone">Phone</label>
        <input type="text" class="form-control" id="owner-phone" placeholder="Enter phone number" name="owner-phone">
      </div>
      <button type="submit" class="btn btn-primary" :disabled="hasInvalidForm">Submit</button>
    </form>
  </div>
@endsection
