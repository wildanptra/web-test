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
                            <li class="breadcrumb-item active">Shipment</li>
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
                                    <h4>Data Shipment</h4>
                                </div>

                                <div class="card-body">

                                    <button type="button" class="btn btn-sm btn-primary mt-2 mb-4" onclick="add()">
                                        <i class="fa fa-plus"></i> Add Shipment 
                                    </button>

                                    <button type="button" class="btn btn-sm btn-secondary mt-2 mb-4" onclick="reloadTable()">
                                    <i class="fa fa-sync"></i> Reload 
                                    </button>
                                    

                                    <table class="table table-striped table-bordered table-hover" id="table-shipment" width="100%">
                                        
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date Shipment</th>
                                                <th>Address</th>
                                                <th>Courier Name</th>
                                                <th>Status Shipment</th>
                                                <th>Action</th>
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
            let modalAddShipment = $('#modalAddShipment');
            let tableShipment = $('#table-shipment');
            let formAddShipment = $('#formAddShipment');
            let modalTitleShipment = $('#modalTitleShipment');
            let closeModalShipment = $('#closeModalShipment');
            let btnCloseModalShipment = $('#btnCloseModalShipment');
            let btnSaveModalShipment= $('#btnSaveModalShipment');

            // selected option
            let productShipment    = $('#product-shipment');
            let qtyShipment        = $('#qty-shipment');
            let priceShipment      = $('#price-shipment');
            let totalShipment      = $('#total-shipment');
            // end selected option

            // let btnEdit = $('#btnEdit');

            $(document).ready(function(){

                tableShipment.DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "shipment" : [],
                    "ajax": {
                        "url" : "<?= site_url('auth/shipment/getData')?>",
                        "type" : "POST",
                    },
                    "columnDefs": [
                        { 
                            "targets": [0,5],
                            "orderable": false,
                        },
                    ],
                    "language": {
                        "zeroRecords": "Belum ada shipment, silahkan tambah shipment terlebih dahulu.",
                        "infoEmpty": "No records available"
                    }
                })

            });

                closeModalShipment.click(function(){
                    modalAddShipment.modal('hide');
                });

                btnCloseModalShipment.click(function(){
                    modalAddShipment.modal('hide');
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

                function deleteConfirm(id, name = 'shipment') {
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

                function bayarShipmentConfirm(id, name = 'shipment') {
                    Swal.fire({
                        title: 'Konfirmasi Bayar',
                        text: "apakah anda ingin membayar " + name + " ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            bayarShipment(id);
                        }
                    })
                }

                function reloadTable() {
                    tableShipment.DataTable().ajax.reload();
                }

                function add() {
                    saveData = 'add';
                    formAddShipment[0].reset();
                    modalAddShipment.modal('show');
                    modalTitleShipment.text('Form Add Shipment');
                }

                function save() {
                    
                    btnSaveModalShipment.text('Mohon tunggu...');
                    btnSaveModalShipment.attr('disabled', true);

                    if( saveData == 'add' ) {
                        url = "<?= site_url('auth/shipment/create') ?>";
                    }else if( saveData == 'edit' ) {
                        url = "<?= site_url('auth/shipment/update') ?>";
                    }

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formAddShipment.serialize(),
                        dataType: "json",
                        success: function(response) {
                            if(response.status == 'sukses') {
                                modalAddShipment.modal('hide');
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
                                btnSaveModalShipment.text('Save');
                                btnSaveModalShipment.attr('disabled', false);
                            }

                            
                            if(saveData == 'edit'){
                                btnSaveModalShipment.text('Save');
                                btnSaveModalShipment.attr('disabled', false);
                            }

                        },
                        error : function() {
                            message('error','Server sedang ada gangguan, silahkan ulangi kembali');

                            if(saveData == 'add'){
                                btnSaveModalShipment.text('Save');
                                btnSaveModalShipment.attr('disabled', false);
                            }

                            
                            if(saveData == 'edit'){
                                btnSaveModalShipment.text('Save');
                                btnSaveModalShipment.attr('disabled', false);
                            }
                        }
                    });

                }

                function byid(id_shipment, type) {

                    if( type == 'edit' ) {
                        saveData = 'edit';
                        formAddShipment[0].reset();
                    }

                    $.ajax({
                        type : 'GET',
                        url: "<?= site_url('auth/shipment/byid/') ?>" + id_shipment,
                        dataType: "json",
                        success : function(response){
                            // kalau error cek dulu di console pake console.log(response);
                            
                            if( type == 'edit' ) {
                                formAddShipment.find('input').removeClass('is-invalid');
                                modalTitleShipment.text('Form Edit Shipment');
                                btnSaveModalShipment.text('Save');
                                btnSaveModalShipment.attr('disabled', false);
                                $('[name="id_shipment"]').val(response.id_shipment);
                                $('[name="date_shipment"]').val(response.date_shipment);
                                $('[name="address"]').val(response.address);
                                $('[name="courier_name"]').val(response.courier_name);
                                modalAddShipment.modal('show');

                            }else if( type == 'delete' ) {

                                deleteConfirm(response.id_shipment,response.name);

                            }else if( type == 'bayar' ) {
                                
                                bayarShipmentConfirm(response.id_shipment,response.name);
                                
                            }

                        },
                        error: function(){
                            message('error','Server sedang ada gangguan, silahkan ulangi kembali');

                            if(saveData == 'add'){
                                btnSaveModalShipment.text('Save');
                                btnSaveModalShipment.attr('disabled', false);
                            }

                            
                            if(saveData == 'edit'){
                                btnSaveModalShipment.text('Save');
                                btnSaveModalShipment.attr('disabled', false);
                            }

                        },

                    });

                }

                function deleteData(id_shipment) {

                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('auth/shipment/delete/')?>" + id_shipment,
                        dataType: "JSON",
                        success: function (response) {
                            // console.log(response);
                            reloadTable();
                            message('success','Data Berhasi di Hapus');
                        },
                        error: function(){
                            message('error','Server sedang ada gangguan, silahkan ulangi kembali');
                        },
                    });

                }

                function bayarShipment(id_shipment) {

                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('auth/shipment/bayar/')?>" + id_shipment,
                        dataType: "JSON",
                        success: function (response) {
                            // console.log(response);
                            reloadTable();
                            message('success','Transaksi Berhasil');
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
