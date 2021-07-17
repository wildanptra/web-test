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

                        <div id="infoValidasi"></div>
                    
                        <div class="row">
                            <div class="col-md-12">

                            <div class="card mb-4">

                                <div class="card-header">
                                    <h4>Data Shipment Process</h4>
                                </div>

                                <div class="card-body">


                                    <button type="button" class="btn btn-sm btn-primary mt-2 mb-4" onclick="add()">
                                    <i class="fa fa-plus"></i> Add Shipment 
                                    </button>

                                    <button type="button" class="btn btn-sm btn-secondary mt-2 mb-4" onclick="reloadTable()">
                                    <i class="fa fa-sync"></i> Reload 
                                    </button>
                                    

                                    <table class="table table-striped table-bordered table-hover display nowrap" id="table-shipment" width="100%">
                                        
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date Shipment</th>
                                                <th>Address</th>
                                                <th>Courier Name</th>
                                                <th>Grand Total</th>
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
            
            // let btnEdit = $('#btnEdit');

            // select option order shipment
            // let orderShipment = $('#order-shipment');

            // let productOrderShipment   = $('#product-order-shipment');
            // let qtyOrderShipment        = $('#qty-order-shipment');
            // let priceOrderShipment      = $('#price-order-shipment');
            // let totalOrderShipment      = $('#total-order-shipment');
            // end select option order shipment
 
            $(document).ready(function(){

                tableShipment.DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "scrollX": true,
                    "order" : [],
                    "ajax": {
                        "url" : "<?= site_url('auth/shipment/get_json')?>",
                        "type" : "POST",
                    },
                    "columns": [
                        { "data" : "no"},
                        { "data" : "date_shipment"},
                        { "data" : "address"},
                        { "data" : "courier_name" },
                        { "data" : "grandtotal" },
                        { "data" : "status_shipment" },
                        { "data" : "action"},
                    ],
                    "columnDefs": [
                        { 
                            "targets": [0 ,6],
                            "orderable": false,
                        }
                    ],
                    "language": {
                        "zeroRecords": "Belum ada data shipment, silahkan tambah data shipment terlebih dahulu.",
                        "infoEmpty": "No records available"
                    }
                })

            });

            $(document).ready(function(){
				

				var no = 1;
				$('#tambah').click(function(){
					no++;
					$('#wrap-add').append('<tr id="row'+no+'"><td><select name="id_order[]" class="form-control order-shipment"><option value="" selected disabled>- Choose Order -</option><?php foreach($order as $data): ?><?php if($data->status_order == 'selesai' ): ?><option data-product="<?= $data->name_product; ?>" data-qty="<?= $data->qty; ?>" data-price="<?= $data->price; ?>" data-total="<?= $data->total; ?>" value="<?= $data->id_order ?>">(<?= $data->username_user; ?>) - <?= $data->name_product; ?> - Total : <?= $data->total; ?> - Tanggal Transaksi : <?= $data->tanggal_transaksi; ?> (<?= $data->status_order; ?>)</option><?php endif; ?><?php endforeach; ?></select></td><td><input type="text" name="product_order_shipment" placeholder="Product Name.." class="form-control product-order-shipment" readonly /></td><td><input type="text" placeholder="Quantity.." class="form-control qty-order-shipment" readonly /></td><td><input type="text" placeholder="Price.." class="form-control price-order-shipment" readonly /></td><td><input type="text" placeholder="Total.." class="form-control total-order-shipment" readonly /></td><td><button type="button" id="'+no+'"class="btn btn-danger btn-sm mt-1 btn_remove"><i class="fa fa-trash-alt"></i></button></td></tr>');
				});

				$(document).on('click', '.btn_remove', function(){
					var button_id = $(this).attr("id"); 
					$('#row'+button_id+'').remove();

                    var grandtotal = parseInt(0);
                    
                    $('.total-order-shipment').each(function() {
                        var total = parseInt($(this).val());
                        grandtotal-=total;
                        hasil = Math.abs(grandtotal)
                        $('#grandtotal-shipment').val(hasil);
                    });
				});

                $(document).on('change','.order-shipment',function(){     

                    let row = $(this).closest('tr');

                    var displayProductOrderShipment = $(this).find('option:selected').data('product');

                    row.find('.product-order-shipment').val(displayProductOrderShipment);

                    var displayQtyOrderShipment = $(this).find('option:selected').data('qty');

                    row.find('.qty-order-shipment').val(displayQtyOrderShipment);

                    var displayPriceOrderShipment = $(this).find('option:selected').data('price');

                    row.find('.price-order-shipment').val(displayPriceOrderShipment);

                    var displayTotalOrderShipment = $(this).find('option:selected').data('total');

                    row.find('.total-order-shipment').val(displayTotalOrderShipment);

                    var grandtotal = parseInt(0);
                    
                    $('.total-order-shipment').each(function() {
                        var total = parseInt($(this).val());
                        grandtotal+=total;
                        $('#grandtotal-shipment').val(grandtotal);
                    });

                });

			});

                closeModalShipment.click(function(){
                    modalAddShipment.modal('hide');
                });

                btnCloseModalShipment.click(function(){
                    modalAddShipment.modal('hide');
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
                            console.log(response);
                            if( type == 'edit' ) {
                                formAddShipment.find('input').removeClass('is-invalid');
                                modalTitleShipment.text('Form Edit Shipment');
                                btnSaveModalShipment.text('Save');
                                btnSaveModalShipment.attr('disabled', false);
                                $('[name="id_shipment"]').val(response.id_shipment);
                                $('[name="date_shipment"]').val(response.date_shipment);
                                $('[name="address"]').val(response.address);
                                $('[name="courier_name"]').val(response.courier_name);
                                $('[name="grandtotal"]').val(response.grandtotal);
                                $('[name="status_shipment"]').val(response.status_shipment);
                                modalAddShipment.modal('show');

                            }else if( type == 'delete' ) {

                                deleteConfirm(response.id_shipment,response.name);

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

            

        </script>

        <!-- ===================================== END CUSTOM JS HERE ===================================== -->

    </body>
</html>
