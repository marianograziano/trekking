<div class="px-3 py-2 text-white" style="background-color: #277527b0; color: white">
  <div class="container">
    <? include 'svg.php'; ?>
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-center">
      <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
        <svg class="bi me-2" width="60" height="60" role="img" aria-label="mountain">
          <use xlink:href="#mountain"></use>
        </svg>
        <h1 class="display-5">Trekking y Senderismo</h1>
      </a>

      <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
        <li>
          <a href="./" class="nav-link text-white">
            <svg class="bi d-block mx-auto mb-1" width="24" height="24">
              <use xlink:href="#home"></use>
            </svg>
            Inicio
          </a>
        </li>
        <li>
          <a href="./contact_us" class="nav-link text-white">
            <svg class="bi d-block mx-auto mb-1" width="24" height="24">
              <use xlink:href="#hike"></use>
            </svg>
            Senderos
          </a>
        </li>

        <li>
          <a href="./about_us" class="nav-link text-white">
            <svg class="bi d-block mx-auto mb-1" width="24" height="24">
              <use xlink:href="#speedometer2"></use>
            </svg>
            Nosotros
          </a>
        </li>

        <a href="#" class="nav-link text-white">
          <svg class="bi d-block mx-auto mb-1" width="24" height="24">
            <use xlink:href="#grid"></use>
          </svg>
          Contacto
        </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="px-3 py-2 border-bottom mb-3">
  <div class="container d-flex flex-wrap justify-content-center">
    <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto">
      <!-- TODO SELECT2 -->
      <input type="search" class="form-control" placeholder="Buscar" aria-label="Search" />
    </form>
    <div class="dropdown text-end">
      <?php
      // Inicializa $username como una cadena vacía.

      // Verifica si el nombre de usuario existe en la sesión y asigna su valor a $username.
      if (isset($_SESSION["user"]["username"]) && $_SESSION["user"]["username"] != '') {
     
?>

      <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
        data-bs-toggle="dropdown" aria-expanded="false">
        <svg width="32" height="32" class="rounded-circle">
          <use xlink:href="#people-circle"></use>
        </svg>
      </a>
      <a href="#" class="d-block">
        <?= $username ?>
      </a>

      <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" href="#">Perfil</a></li>
        <li>
          <hr class="dropdown-divider" />
        </li>
        <li><a class="dropdown-item" href="../includes/layout/logout.php">Salir</a></li>
      </ul>
      
      <?
      } else {
        echo '<a href="login.php" class="d-block">Iniciar sesión</a>'; // Asumiendo que 'login.php' es tu página de inicio de sesión.
      }
      ?>
    </div> 
 


  </div>
</div>
</div>