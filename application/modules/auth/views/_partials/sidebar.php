<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menu</div>
            
            <a class="nav-link" href="<?= site_url('auth/landing') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                Product
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?= site_url('auth/product') ?>"> <div class="sb-nav-link-icon"><i class="fas fa-folder"></i>
                    </div> Data Product </a>

                    <a class="nav-link" href="<?= site_url('auth/category') ?>"> <div class="sb-nav-link-icon"><i class="fas fa-folder"></i>
                    </div>Category Product</a>
                </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOrder" aria-expanded="false" aria-controls="collapseOrder">
                <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                Order
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseOrder" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?= site_url('auth/order') ?>"> <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div> Order Product </a>

                    <a class="nav-link" href="<?= site_url('auth/order/data_transaksi') ?>"> <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div> Data Transaction </a>
                </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseShipment" aria-expanded="false" aria-controls="collapseShipment">
                <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                Shipment
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseShipment" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?= site_url('auth/shipment') ?>"> <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div> Shipment Process </a>
                    <!-- <a class="nav-link" href="<?= site_url('auth/shipment_order') ?>"> 
                        <div class="sb-nav-link-icon"><i class="fas fa-shipping-fast"></i></div> Shipment Order 
                    </a> -->
                </nav>
            </div>

        </div>
    </div>
    
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        WEB TEST (<?= $this->session->userdata('role') ?>)
    </div>
</nav>