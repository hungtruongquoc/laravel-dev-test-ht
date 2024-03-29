@extends('layouts.main')
@section('content')
  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Let's get your vehicle back on the trail!</h1>
        </div>
      </div>
    </div>
  </header>
  <!-- List Tickets -->
  <section class="bg-light">
    <div class="container" id="request-list">
      @if (session('createStatus') || session('updateStatus'))
        <div class="row" id="flash-alert-container">
          <div class="alert alert-success col">
            {{ session('createStatus') }}
            {{ session('updateStatus') }}
          </div>
        </div>
      @endif
      <div class="row">
        <form style="width:100%" method="GET" data-url="{{route('home')}}" action="{{route('home')}}"
              ref="searchForm" @submit="attachSearchText">
          <div class="form-row pt-5 pb-5">
            <div class="col-10">
              <label for="search-text" class="sr-only">Type text to search and click 'Search'</label>
              <input type="text" class="form-control" id="search-text" ref="searchText"
                     placeholder="Type text to search and click 'Search'" v-model="searchText">
            </div>
            <div class="col-2">
              <button type="submit" class="btn btn-secondary btn-block" :disabled="hasNoSearchText">Search</button>
            </div>
          </div>
        </form>
      </div>
      <div class="row">
        <table class="table table-striped">
          <thead>
          <th class="text-right">Ticket #</th>
          <th>Client Name</th>
          <th>Status</th>
          <th class="text-center">Last Update</th>
          <th>Action</th>
          </thead>
          <tbody>
          @foreach($requests AS $request)
            <tr>
              <td class="text-right">{{ $request->id }}</td>
              <td>{{ $request->client_name }}</td>
              <td class="text-capitalize">{{ $request->status }}</td>
              <td class="text-center">{{ $request->updated_at->format('m/d/Y h:i A') }}</td>
              <td>
                <a href="{{ route('edit',[$request->id]) }}" class="btn btn-primary">EDIT</a>
                <a href="{{ route('service-request.delete',[$request->id]) }}" class="btn btn-danger"
                   @click="deleteItem" data-item-id="{{$request->id}}">DELETE</a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
        {{ $requests->links() }}
      </div>
    </div>
  </section>

@endsection
