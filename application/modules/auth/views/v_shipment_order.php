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
                            <li class="breadcrumb-item"><a href="<?= site_url('auth/shipment'); ?>">Shipment</a></li>
                            <li class="breadcrumb-item active">Shipment Order</li>
                        </ol>  

                        <?php if ($this->session->flashdata('message')) { ?>                
                            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                                <?= $this->session->flashdata('message'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>

                        <div id="infoValidasi"></div>
                    
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card mb-4">

                                    <div class="card-header">
                                        <h4>Data Shipment Order</h4>
                                    </div>

                                    <div class="card-body">


                                            <button type="button" class="btn btn-sm btn-primary mt-2 mb-4" onclick="addShipmentOrder()">
                                            <i class="fa fa-plus"></i> Add Shipment Order 
                                            </button>

                                            <button type="button" class="btn btn-sm btn-secondary mt-2 mb-4" onclick="reloadTable()">
                                            <i class="fa fa-sync"></i> Reload 
                                            </button>
                                            

                                            <table class="table table-striped table-bordered table-hover display nowrap" id="table-shipment-order" width="100%">
                                                
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Consument Name</th>
                                                        <!-- <th>Address</th> -->
                                                        <th>Product</th>
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
            let modalAddShipmentOrder = $('#modalAddShipmentOrder');
            let tableShipmentOrder = $('#table-shipment-order');
            let formAddShipmentOrder = $('#formAddShipmentOrder');
            let modalTitleShipmentOrder = $('#modalTitleShipmentOrder');
            let closeModalShipmentOrder = $('#closeModalShipmentOrder');
            let btnCloseModalShipmentOrder = $('#btnCloseModalShipmentOrder');
            let btnSaveModalShipmentOrder= $('#btnSaveModalShipmentOrder');
            // let btnEdit = $('#btnEdit');
                            
            $(document).ready(function(){

                tableShipmentOrder.DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "scrollX": false,
                    "fixedColumns" : false,
                    "searchHighights" : true,
                    "order" : [],
                    "ajax": {
                        "url" : "<?= site_url('auth/shipment_order/get_json')?>",
                        "type" : "POST",
                    },
                    "columns": [
                        { "data" : "no"},
                        { "data" : "username_user"},
                        // { "data" : "address_shipment"},
                        { "data" : "name_product" },
                        { "data" : "qty_order" },
                        { "data" : "price_order" },
                        { "data" : "total_order"},
                    ],
                });

                // tableShipmentOrder.columns.adjust();
            });

            closeModalShipmentOrder.click(function(){
                    modalAddShipmentOrder.modal('hide');
                });

                btnCloseModalShipmentOrder.click(function(){
                    modalAddShipmentOrder.modal('hide');
                });

                function message(icon, text) {
                    Swal.fire({
                        icon: icon,
                        title: 'Data Shipment',
                        text: text,
                        showCancelButton : false,
                        showCloseButton: false,
                        timer: 3000,
                        timerProgressBar : true,
                    });
                }

                function deleteConfirm(id, name = 'Shipment') {
                    Swal.fire({
                        title: 'Apakah anda yakin ?',
                        text: "akan menghapus data " + name,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            deleteData(id);
                        }
                    })
                }

                function reloadTable() {
                    tableProduct.DataTable().ajax.reload();
                }

                function addShipmentOrder() {
                    saveData = 'add';
                    formAddShipmentOrder[0].reset();
                    modalAddShipmentOrder.modal('show');
                    modalTitleShipmentOrder.text('Form Add Shipment Order');
                }

                function saveShipmentOrder() {
                    
                    btnSaveModalShipmentOrder.text('Mohon tunggu...');
                    btnSaveModalShipmentOrder.attr('disabled', true);

                    if( saveData == 'add' ) {
                        url = "<?= site_url('auth/shipment_order/create') ?>";
                    }else if( saveData == 'edit' ) {
                        url = "<?= site_url('auth/shipment_order/update') ?>";
                    }

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formAddShipmentOrder.serialize(),
                        dataType: "json",
                        success: function(response) {
                            if(response.status == 'sukses') {
                                modalAddShipmentOrder.modal('hide');
                                reloadTable();
                                if( saveData == 'add' ) {
                                    message('success','Data Berhasil di Tambah');
                                }else if( saveData == 'edit' ) {
                                    message('success','Data Berhasil di Edit');
                                }
                            } else {
                                
                                for (let i = 0; i < response.inputerror.length; i++) {
                                    $('[name="'+ response.inputerror[i] +'"]').addClass('is-invalid');
                                    $('[name="'+ response.inputerror[i] +'"]').next().text(response.error_string[i]);
                                }
                                
                            }

                            if(saveData == 'add'){
                                btnSaveModalShipmentOrder.text('Save');
                                btnSaveModalShipmentOrder.attr('disabled', false);
                            }

                            
                            if(saveData == 'edit'){
                                btnSaveModalShipmentOrder.text('Save');
                                btnSaveModalShipmentOrder.attr('disabled', false);
                            }

                        },
                        error : function() {
                            message('error','Server sedang ada gangguan, silahkan ulangi kembali');

                            if(saveData == 'add'){
                                btnSaveModalShipmentOrder.text('Save');
                                btnSaveModalShipmentOrder.attr('disabled', false);
                            }

                            
                            if(saveData == 'edit'){
                                btnSaveModalShipmentOrder.text('Save');
                                btnSaveModalShipmentOrder.attr('disabled', false);
                            }
                        }
                    });

                }

                function byid(id_product, type) {

                    if( type == 'edit' ) {
                        saveData = 'edit';
                        formAddProduct[0].reset();
                    }

                    $.ajax({
                        type : 'GET',
                        url: "<?= site_url('auth/product/byid/') ?>" + id_product,
                        dataType: "json",
                        success : function(response){
                            
                            if( type == 'edit' ) {
                    
                                formAddProduct.find('input').removeClass('is-invalid');
                                modalTitleProduct.text('Form Edit Product');
                                btnSaveModalProduct.text('Save');
                                btnSaveModalProduct.attr('disabled', false);
                                $('[name="id_product"]').val(response.id_product);
                                $('[name="name"]').val(response.name);
                                $('[name="description"]').val(response.description);
                                $('[name="id_category"]').val(response.id_category);
                                $('[name="stock"]').val(response.stock);
                                $('[name="price"]').val(response.price);
                                modalAddProduct.modal('show');

                            }else if( type == 'delete' ) {

                                deleteConfirm(response.id_product,response.name);

                            }

                        },
                        error: function(){

                            message('error','Server sedang ada gangguan, silahkan ulangi kembali');

                            if(saveData == 'add'){
                                btnSaveModalOrder.text('Save');
                                btnSaveModalOrder.attr('disabled', false);
                            }

                            
                            if(saveData == 'edit'){
                                btnSaveModalOrder.text('Save');
                                btnSaveModalOrder.attr('disabled', false);
                            }
                        },

                    });

                }

                function deleteData(id_product) {

                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('auth/product/delete/')?>" + id_product,
                        dataType: "JSON",
                        success: function (response) {
                            reloadTable();
                            message('success','Data Berhasi di Hapus');
                        },
                        error: function(){
                            message('error','Server sedang ada gangguan, silahkan ulangi kembali');
                        },
                    });

                }

            

        </script>

        <!-- ===================================== END CUSTOM JS HERE ===================================== -->

    </body>
</html>
