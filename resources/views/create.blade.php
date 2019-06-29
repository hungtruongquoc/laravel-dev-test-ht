@extends('layouts.main')
@section('content')
  <div class="container" id="app">
    <form method="POST" action="{{route('store')}}">
      @component('select', ['title' => 'Make', 'items' => $makes, 'id' => 'vehicle-make', 'name' => 'vehicle-make',
       'autofocus' => true])
      @endcomponent
      @component('select', ['title' => 'Model', 'items' => [], 'id' => 'vehicle-model', 'name' => 'vehicle-model',
      'disabled' => true])
      @endcomponent
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
