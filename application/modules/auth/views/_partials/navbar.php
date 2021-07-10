<nav class="sb-topnav navbar navbar-expand navbar-dark bg-success">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="<?= site_url('auth/landing'); ?>">WEB TEST</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 float-right" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

    <!-- Navbar-->
    <ul class="navbar-nav d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i><?= $this->session->userdata('name') ?> </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= site_url('auth/login/logout') ?>">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>