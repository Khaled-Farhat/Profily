<nav class="shadow-sm sticky-top navbar navbar-expand-lg navbar-light bg-light py-3">
  <div class="container">
    <a class="navbar-brand" href="<?= URL ?>">Profily</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mx-2">
          <a class="nav-link" href="<?= URL ?>">Home</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="<?= URL . '/Home/viewRecentPosts' ?>">Recent Posts</a>
        </li>
      </ul>
      <div class="d-flex">
        <a class="btn btn-outline-dark mx-1" href="<?= URL . '/Login' ?>">Login</a>
        <a class="btn btn-primary mx-1 bg-gradient" href="<?= URL . '/Signup' ?>">Signup</a>
      </div>
    </div>
  </div>
</nav>