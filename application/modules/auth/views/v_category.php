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
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Data Category</h3>
                                
                                <!-- Button trigger modal add category -->
                                <button type="button" class="btn btn-sm btn-primary mt-3 mb-3" data-toggle="modal" data-target="#modalAddCategory">
                                    Add Category
                                </button>

                                <table class="table table-striped" id="table-category">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    </tbody>
                                </table>
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
            $('#table-category').DataTable({
                "processing" : true,
                "serverSide" : true,
                "order" : [],
                "ajax": {
                    "url" : "<?= site_url('auth/category/get_json')?>",
                    "type" : "POST",
                },
                "columns ": [
                    { "data" : "no", width:40 },
                    { "data" : "name", width:150 },
                    { "data" : "description", width:150 },
                    { "data" : "action", width:100 },
                ],
            })
        </script>

        <!-- ===================================== END CUSTOM JS HERE ===================================== -->

    </body>
</html>
