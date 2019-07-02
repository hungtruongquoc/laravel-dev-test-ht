@extends('layouts.main')
@section('content')
  <div class="container" id="app">
    @if($errors->any())
      <div class="alert alert-danger" id="error-message">Please correct invalid inputs</div>
    @endif
    <small id="emailHelp" class="form-text text-info">* - All fields are required</small>
    <form @if(isset($currentRequest))
            action="{{route('patch', ['id' => $requestId])}}"
          @else
            action="{{route('store')}}"
          @endif
          @submit="checkFormValidity" method="POST"
          @if(isset($currentRequest)) data-current-request="{{$currentRequest}}" @endif
          id="request-form">
      @csrf
      @if(isset($currentRequest))
        @method('PATCH')
      @endif
      <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control @error('status') is-invalid @enderror" id="status"
               placeholder="Type status" data-old-value="{{old('status')}}"
               @if(isset($status)) value="{{$status}}" @endif
               name="status" maxlength="200" v-model="status" :disabled="hasNoRequestId">
        @error('status')
        <span class="invalid-feedback">{{$message}}</span>
        @enderror
      </div>
      <app-select title="Make" :id="'vehicle-make'" :name="'vehicle-make'"
                  data-property="makeList" v-model="selectedMake"
                  @selected-item-changed="loadModels" :items="makeList" :autofocus="true" data-list="{{$makes}}">
        <template v-slot:item-title="slotProps">
          @{{ slotProps.item.title }}
        </template>
      </app-select>
      <app-select title="Model" :id="'vehicle-model'" :name="'vehicle_model_id'" :items="modelList"
                  v-model="selectedModel">
        <template v-slot:item-title="slotProps">
          @{{ slotProps.item.title }}
        </template>
      </app-select>
      <div class="form-group">
        <label for="owner-name">Customer's Name</label>
        <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client-name"
               placeholder="Please provide your full name" data-old-value="{{old('client_name')}}"
               name="client_name" maxlength="200" v-model="client_name">
        @error('client_name')
        <span class="invalid-feedback">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="owner-email">Email Address</label>
        <input type="email" class="form-control @error('client_email') is-invalid @enderror" id="client-email"
               aria-describedby="emailHelp" data-old-value="{{old('client_email')}}"
               placeholder="Enter email" name="client_email" v-model="client_email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        @error('client_email')
        <span class="invalid-feedback">{{$message}}</span>
        @enderror
        <span class="js-feedback invalid-feedback" v-if="hasInvalidEmail">Your email is invalid</span>
      </div>
      <div class="form-group">
        <label for="owner-phone">Phone</label>
        <input type="text" class="form-control @error('client_phone') is-invalid @enderror" id="client-phone"
               placeholder="Enter phone number xxx-xxx-xxxx" name="client_phone"
               data-old-value="{{old('client_phone')}}" v-model="client_phone">
        @error('client_phone')
        <span class="invalid-feedback">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group">
        <input type="hidden" value="{{old('description')}}" id="previous-description">
        <textarea id="service-description" name="description" data-old-value="{{old('description')}}"
                  class="form-control @error('description') is-invalid @enderror " v-model="description"></textarea>
        @error('description')
        <span class="invalid-feedback">{{$message}}</span>
        @enderror
      </div>
      <button class="btn btn-light" @click="goBackToListPage">Cancel</button>
      <button type="submit" class="btn btn-primary" :disabled="hasInvalidForm">Submit</button>
    </form>
  </div>
@endsection
