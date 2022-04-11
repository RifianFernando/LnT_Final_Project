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
            <a class="nav-link {{($title === "About Us") ? 'active' : ''}}" aria-current="page" href="/about"><b>About Us</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{($title === "Cart") ? 'active' : ''}}" aria-current="page" href="{{ route('cart') }}"><b>Cart</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{($title === "Create") ? 'active' : ''}}" aria-current="page" href="/addproduct"><b>Add Product</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{($title === "delete") ? 'active' : ''}}" aria-current="page" href="/deleteproduct"><b>Delete Product</b></a>
          </li>
        </ul>
        <ul class= "navbar-nav ms-auto">
        <li class= "nav-item">
            <a class="nav-link {{($title === "Login") ? 'active' : ''}}" aria-current="page" href="/Login"><i class="bi bi-box-arrow-in-right"></i><b>Login</b></a>
        </li>
        </ul>
      </div>
    </div>
</nav>
