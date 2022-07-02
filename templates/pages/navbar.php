<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand text-white" href="http://localhost/petshopqu/">
    <img src="http://localhost/petshopqu/templates/img/logo-cat.png" class="mb-1" alt="logo" height="35">
    <span class="ml-2">PETSHOPQU</span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mr-2">
      <li class="nav-item active">
        <a class="nav-link active" href="http://localhost/petshopqu/">BERANDA<span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="produk.php">PRODUK<span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="register.php">REGISTER<span class="sr-only"></span></a>
      </li>
      
      <?php if ( isset($_SESSION["username"]) ) { ?>
        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            halo, <?php echo $_SESSION['username'] ?>!
          </a>
          <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item text-white" href="logout.php">logout</a>
          </div>
        </li>
      <?php } else { ?>
        <li class="nav-item active">
          <a class="nav-link" href="login.php">LOGIN <span class="sr-only"></span></a>
        </li>
      <?php } ?>
    </ul>
  </div>
</nav>