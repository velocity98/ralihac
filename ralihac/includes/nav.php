<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-info">
  <div class="container">
    <a class="navbar-brand" href="index.php">Ralihac</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav mr-auto">
        <li class='nav-item'>
          <a class='nav-link'>Categories</a> <!-- Put functionality plus make some dropdown-->
        </li>
        <li class='nav-item active'>
          <a class='nav-link'>Create Hack</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link'>Popular Hacks</a>
        </li>
      </ul>

      <ul class='navbar-nav mr-auto'>
        <li class="nav-item">
          <form class="form-inline my-0 my-lg-0">
            <div class='input-group'>
              <input class="form-control searchstyle" type="search" placeholder="Search">
              <div class='input-group-append'>
                <button class="btn input-group-text" type="submit"><img src='images/siteimages/find.png' class='find-image'/></button>
              </div>
            </div>
         </form>
        </li>
      </ul>

      <ul class="navbar-nav">
        <?php if(is_logged_in_user() == false): ?>
          <li class='nav-item'>
            <a href='login.php' class='nav-link active'><i class='fas fa-sign-in-alt'></i> Login</a>
          </li>
        <?php else: ?>
        <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="fas fa-user"></i> Hello <?php echo $username?>
         </a>

         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="#">Action</a>
           <a class="dropdown-item" href="#">Another action</a>
           <div class="dropdown-divider"></div>
           <a class="dropdown-item" href="logout.php">Logout</a>
         </div>
       </li>
       <?php endif; ?>
      </ul>
    </div>
  </div>

</nav>
