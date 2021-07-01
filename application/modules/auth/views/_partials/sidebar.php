<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menu</div>
            
            <a class="nav-link" href="<?= site_url('auth/landing') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                Dashboard
            </a>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                Category
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?= site_url('auth/category') ?>"> Data Category </a>
                </nav>
            </div>

        </div>
    </div>
    
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        WEB TEST (<?= $this->session->userdata('role') ?>)
    </div>
</nav>