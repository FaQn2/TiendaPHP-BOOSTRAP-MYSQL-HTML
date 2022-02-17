 

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
   
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="http://localhost/System32/index.php">System32</a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost/System32/index.php"><img src="http://localhost/System32/images/icon-home.png" width="32" height="32" /></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/System32/tienda.php"><img src="http://localhost/System32/images/carrito.png" width="32" height="32" /></a>
        </li>
         <li class="nav-item">
          <a class="nav-link "href='http://localhost/System32/login.php'><img src="http://localhost/System32/images/login.png" width="32" height="32" /></a>
          <?php
          if (isset($_SESSION["id_cliente"]))
          {
              if ($_SESSION["admin"] == 1)
              {
                  echo "<a href='http://localhost/System32/backend/backend.php'> ingresar al Sistema</a> ";
              }
              echo $_SESSION["cliente"] . " <a href='http://localhost/System32/logout.php'>Cerrar Sesión</a>";
          }
          else
          {

              echo "<a  href='http://localhost/System32/login.php'></a>";

          }
            ?> 
        </li> 
         
      </ul>
      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
        
</nav>