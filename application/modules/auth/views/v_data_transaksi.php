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
                                    

                                    <table class="table table-striped table-bordered table-hover display nowrap" id="table-order" width="100%">
                                        
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>Name Product</th>
                                                <th>Transaction Date</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
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
                    "scrollX": true,
                    "order" : [],
                    "ajax": {
                        "url" : "<?= site_url('auth/order/get_transaksi_json')?>",
                        "type" : "POST",
                    },
                    "columns": [
                        { "data" : "no"},
                        { "data" : "username_user"},
                        { "data" : "name_product"},
                        { "data" : "tanggal_transaksi"},
                        { "data" : "qty"},
                        { "data" : "price",render: $.fn.dataTable.render.number(',', '.', '')},
                        { "data" : "total",render: $.fn.dataTable.render.number(',', '.', '')},
                        { "data" : "action"},
                    ],
                    "columnDefs": [
                        { 
                            "targets": [0 ,7],
                            "orderable": false,
                        },
                    ],
                    "language": {
                        "zeroRecords": "Belum ada data transaksi yang selesai, silahkan tambah order terlebih dahulu.",
                        "infoEmpty": "No records available"
                    }
                })

            });

            function message(icon, text) {
                    Swal.fire({
                        icon: icon,
                        title: 'Data Transaksi',
                        text: text,
                        showCancelButton : false,
                        showCloseButton: false,
                        timer: 3000,
                        timerProgressBar : true,
                    });
                }

                function deleteConfirm(id, name = 'transaksi') {
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
                tableOrder.DataTable().ajax.reload();
            }

            function byid(id_order, type) {

                if( type == 'edit' ) {
                    saveData = 'edit';
                    formAddOrder[0].reset();
                }

                $.ajax({
                    type : 'GET',
                    url: "<?= site_url('auth/order/byid/') ?>" + id_order,
                    dataType: "json",
                    success : function(response){
                        // kalau error cek dulu di console pake console.log(response);
                        
                        if( type == 'edit' ) {
                            formAddOrder.find('input').removeClass('is-invalid');
                            modalTitleOrder.text('Form Edit Order');
                            btnSaveModalOrder.text('Save');
                            btnSaveModalOrder.attr('disabled', false);
                            $('[name="id_order"]').val(response.id_order);
                            $('[name="id_product"]').val(response.id_product).data('price');
                            $('[name="qty"]').val(response.qty);
                            $('[name="price"]').val(response.price);
                            $('[name="total"]').val(response.total);
                            modalAddOrder.modal('show');

                        }else if( type == 'delete' ) {

                            deleteConfirm(response.id_order,response.name);

                        }else if( type == 'bayar' ) {
                            
                            bayarOrderConfirm(response.id_order,response.name);
                            
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

                function deleteData(id_order) {

                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('auth/order/delete/')?>" + id_order,
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


            

        </script>

        <!-- ===================================== END CUSTOM JS HERE ===================================== -->

    </body>
</html>
