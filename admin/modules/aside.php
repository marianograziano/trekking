<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">S&T.ar Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg width="32" height="32" class="rounded-circle">
                            <use xlink:href="#people-circle"></use>
                        </svg>
                    </a>
                    <div class="info">
                        <?php
                        // Asegurarse de que la sesión está iniciada antes de intentar acceder a $_SESSION
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        // Verificar si el usuario está logueado y mostrar su nombre de usuario
                        $username = isset($_SESSION["user"]["username"]) ? htmlspecialchars($_SESSION["user"]["username"], ENT_QUOTES, 'UTF-8') : 'Invitado';
                        ?>
                        <a href="#" class="d-block"><?= $username ?></a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="logout.php">Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="?page=landing" class="nav-link <?= ($page == 'landing') ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Landing</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?page=gpx" class="nav-link <?= ($page == 'gpx') ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>GPX</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?page=senderos" class="nav-link <?= ($page == 'senderos') ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Senderos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>