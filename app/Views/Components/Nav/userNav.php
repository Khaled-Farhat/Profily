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
        <li class="nav-item dropdown ms-auto mx-2">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $data['loggedinUsername'] ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= URL . '/Profile/viewProfile/' . $data['loggedinUsername'] ?>">My Profile</a></li>
            <li><a class="dropdown-item" href="<?= URL . '/Posts/createPost' ?>">Create a post</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= URL . '/Accounts/updatePassword' ?>">Change password</a></li>
            <li><a class="dropdown-item" href="<?= URL . '/Logout' ?>">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>