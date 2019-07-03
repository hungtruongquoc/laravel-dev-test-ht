<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
  <a class="navbar-brand" href="#"><img src="/img/logo.png" style="max-height:75px;">Jim's Offroad Service</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav" style="position: relative; width: 100%">
      <li class="nav-item @active_route('home') active @endactive_route">
        <a class="nav-link" href="{{ route('home') }}">Current Tickets</a>
      </li>
      <li class="nav-item @active_route('create') active @endactive_route">
        <a class="nav-link" href="{{ route('create') }}">Create a Ticket</a>
      </li>
      <li class="nav-item" style="position: absolute; right: 0">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-light">Logout</button>
        </form>
      </li>
    </ul>
  </div>
</nav>
