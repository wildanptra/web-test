<!DOCTYPE html>
<html lang="en">

    <!-- Header Location: (_partials/header.php) -->
    <?php $this->load->view("_partials/header.php") ?>

    <body class="sb-nav-fixed">

        <!-- Navbar Location: (_partials/navbar.php) -->
        <?php $this->load->view("_partials/navbar.php") ?>
        
        <div id="layoutSidenav">

            <div id="layoutSidenav_nav">

                <!-- Sidebar Location: (_partials/sidebar.php) -->
                <?php $this->load->view("_partials/sidebar.php") ?>
        
            </div>

            <div id="layoutSidenav_content">
                
                <main>
                    <div class="container-fluid px-4">

                        <?php if ($this->session->flashdata('message')) { ?>                
                            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                                <?= $this->session->flashdata('message'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <h3 >Welcome, <?= $this->session->userdata('name');  ?> 
                                    (<?= $this->session->userdata('role') ?>)
                                </h3>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-3 col-md-6">
                                <div class="card bg-primary text-white mb-4" style="height: 150px;">
                                <div class="card-body">
                                        <h4>Product</h4>
                                        <p><?= $this->db->count_all_results('tb_product'); ?> Data Product</p>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('auth/product') ?>">See Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-6">
                                <div class="card bg-warning text-white mb-4" style="height: 150px;">
                                    <div class="card-body">
                                        <h4>Category Product</h4>
                                        <p><?= $this->db->count_all_results('tb_product'); ?> Data Category Product</p>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('auth/category') ?>">See Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4" style="height: 150px;">
                                <div class="card-body">
                                        <h4>Order</h4>
                                        <p><?= $this->db->count_all_results('tb_order'); ?> Data Order</p>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('auth/order') ?>">See Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-6">
                                <div class="card bg-danger text-white mb-4" style="height: 150px;">
                                <div class="card-body">
                                        <h4>Shipment</h4>
                                        <p><?= $this->db->count_all_results('tb_shipment'); ?> Data Shipment</p>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('auth/shipment') ?>">See Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </main>

                <!-- Footer Location: (_partials/footer.php) -->
                <?php $this->load->view("_partials/footer.php") ?>

            </div>
        </div>

        <!-- Js Location: (_partials/js.php) -->
        <?php $this->load->view("_partials/js.php") ?>

        <!-- ===================================== CUSTOM JS HERE ===================================== -->

        

        <!-- ===================================== END CUSTOM JS HERE ===================================== -->

    </body>
</html>
