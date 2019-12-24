<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  <div class="container">
    <span class="navbar-brand" href="index.php">Ralihac</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav mr-auto">

        <li class='nav-item'>
          <a class='nav-link'>Categories</a> <!-- Put functionality plus make some dropdown-->
        </li>
        <li class='nav-item'>
          <a class='nav-link'>Popular Hacks</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link'>Most Liked</a>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0">
           <input class="form-control mr-sm-2" type="search" placeholder="Search">
           <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
         </form>
        </li>

      </ul>

      <ul class="navbar-nav">
        <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="fas fa-user"></i> Hello User
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="#">Action</a>
           <a class="dropdown-item" href="#">Another action</a>
           <div class="dropdown-divider"></div>
           <a class="dropdown-item" href="logout.php">Logout</a>
         </div>
       </li>
      </ul>
    </div>
  </div>

</nav>
