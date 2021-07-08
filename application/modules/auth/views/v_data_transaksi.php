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

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item"><a href="<?= site_url('auth/landing'); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('auth/order'); ?>">Order</a></li>
                            <li class="breadcrumb-item active">Data Transaksi</li>
                        </ol>  

                        <?php if ($this->session->flashdata('message')) { ?>                
                            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                                <?= $this->session->flashdata('message'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>

                    
                        <div class="row">
                            <div class="col-md-12">

                            <div class="card mb-4">

                                <div class="card-header">
                                    <h4>Data Transaction</h4>
                                </div>

                                <div class="card-body">

                                    <button type="button" class="btn btn-sm btn-secondary mt-2 mb-4" onclick="reloadTable()">
                                    <i class="fa fa-sync"></i> Reload 
                                    </button>
                                    

                                    <table class="table table-striped table-bordered table-hover" id="table-order" width="100%">
                                        
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>Name Product</th>
                                                <th>Transaction Date</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                        </tbody>

                                    </table>

                                </div>

                            </div>
                            
                            </div>
                        </div>
                    
                    </div>
                </main>

                <!-- Modal Location: (_partials/modal.php) -->
                <?php $this->load->view('_partials/modal.php') ?>

                <!-- Footer Location: (_partials/footer.php) -->
                <?php $this->load->view("_partials/footer.php") ?>

            </div>
        </div>

        <!-- Js Location: (_partials/js.php) -->
        <?php $this->load->view("_partials/js.php") ?>

        <!-- ===================================== CUSTOM JS HERE ===================================== -->

        <script>

            let saveData;
            let modalAddOrder = $('#modalAddOrder');
            let tableOrder = $('#table-order');
            let formAddOrder = $('#formAddOrder');
            let modalTitleOrder = $('#modalTitleOrder');
            let closeModalOrder = $('#closeModalOrder');
            let btnCloseModalOrder = $('#btnCloseModalOrder');
            let btnSaveModalOrder= $('#btnSaveModalOrder');

            // selected option
            let productOrder    = $('#product-order');
            let qtyOrder        = $('#qty-order');
            let priceOrder      = $('#price-order');
            let totalOrder      = $('#total-order');
            // end selected option

            // let btnEdit = $('#btnEdit');

            $(document).ready(function(){

                tableOrder.DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "order" : [],
                    "ajax": {
                        "url" : "<?= site_url('auth/order/getDataTransaksi')?>",
                        "type" : "POST",
                    },
                    "columnDefs": [
                        { 
                            "targets": [0 ,3],
                            "orderable": true,
                        },
                        {
                            "targets" : [1,2,3,4,5],
                        }
                    ],
                    "language": {
                        "zeroRecords": "Belum ada data transaksi yang selesai, silahkan tambah order terlebih dahulu.",
                        "infoEmpty": "No records available"
                    }
                })

            });


            function reloadTable() {
                tableOrder.DataTable().ajax.reload();
            }


            

        </script>

        <!-- ===================================== END CUSTOM JS HERE ===================================== -->

    </body>
</html>
