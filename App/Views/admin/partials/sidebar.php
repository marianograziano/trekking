<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        
        <span class="brand-text font-weight-light">S&T</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview <?php echo (isset($_SESSION['active_menu']) && $_SESSION['active_menu'] == 'dashboard') ? 'menu-open' : ''; ?>">
                    <a href="/public/admin/index.php/dashboard" class="nav-link <?php echo (isset($_SESSION['active_menu']) && $_SESSION['active_menu'] == 'dashboard') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php echo (isset($_SESSION['active_menu']) && $_SESSION['active_menu'] == 'users') ? 'menu-open' : ''; ?>">
                    <a href="/public/admin/index.php/users" class="nav-link <?php echo (isset($_SESSION['active_menu']) && $_SESSION['active_menu'] == 'users') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Usuarios
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php echo (isset($_SESSION['active_menu']) && $_SESSION['active_menu'] == 'senderos') ? 'menu-open' : ''; ?>">
                    <a href="/public/admin/index.php/senderos" class="nav-link <?php echo (isset($_SESSION['active_menu']) && $_SESSION['active_menu'] == 'senderos') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-map"></i>
                        <p>
                            Senderos
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php echo (isset($_SESSION['active_menu']) && $_SESSION['active_menu'] == 'markers') ? 'menu-open' : ''; ?>">
                    <a href="/public/admin/index.php/markers" class="nav-link <?php echo (isset($_SESSION['active_menu']) && $_SESSION['active_menu'] == 'markers') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>
                            Marcadores
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
