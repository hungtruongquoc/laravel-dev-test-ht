@extends('layouts.main')
@section('content')
  <div class="container">
    <form method="POST" action="{{route('store')}}">
      <div class="form-group">
        <label for="vehicle-make">Make</label>
        <select class="form-control" id="vehicle-make" name="vehicle-make">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
      <div class="form-group">
        <label for="vehicle-model">Make</label>
        <select class="form-control" id="vehicle-model" name="vehicle-model">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
      <div class="form-group">
        <label for="owner-name">Owner's Name</label>
        <input type="text" class="form-control" id="owner-name" placeholder="Please provide your full name"
               name="owner-name" maxlength="200">
      </div>
      <div class="form-group">
        <label for="owner-email">Email Address</label>
        <input type="email" class="form-control" id="owner-email" aria-describedby="emailHelp"
               placeholder="Enter email" name="owner-email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="owner-phone">Phone</label>
        <input type="email" class="form-control" id="owner-phone" placeholder="Enter phone number" name="owner-phone">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection
