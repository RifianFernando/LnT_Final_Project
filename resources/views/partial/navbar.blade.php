<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
      <a class="navbar-brand" href="/"><b>Shoppil</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{($title === "Home") ? 'active' : ''}}" aria-current="page" href="/"><b> Home </b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{($title === "About Us") ? 'active' : ''}}" aria-current="page" href="/AboutUs"><b>About Us</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{($title === "Cart") ? 'active' : ''}}" aria-current="page" href="{{ route('cart') }}"><b>Cart</b></a>
          </li>
        </ul>
        <ul class= "navbar-nav ms-auto">
        <li class= "nav-item">
            @if(Route::has('login'))
                @auth
                    @if(Auth::user()->is_admin == true)
                        <a class="nav-link" href="{{ route('dashboardAdmin') }}"><b>Dashboard</b></a>
                    @else
                        <a class="nav-link" href="{{ route('dashboard') }}"><b>Dashboard</b></a>
                    @endif
                @else
                    <a class="nav-link" aria-current="page" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i><b>Login</b></a>
                @endauth
            @endif
        </li>
        </ul>
      </div>
    </div>
</nav>
