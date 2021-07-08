<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title><?= $judul; ?></title>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center mt-5 mx-auto p-4">
                <h1 class="h2">Web Test - Login</h1>
                <p class="lead">Silahkan Login ke Panel Web Test</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mx-auto mt-4">
                <?php if ($this->session->flashdata('message_error')) { ?>                
                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                    <?= $this->session->flashdata('message_error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php } ?>
                <form action="<?= site_url('auth/login') ?>" method="post">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= set_value('username'); ?>" placeholder="Username or Email..">
                        <div class="form-text text-danger"><?= form_error('username'); ?></div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" value="<?= set_value('password'); ?>" placeholder="Password..">
                        <div class="form-text text-danger"><?= form_error('password'); ?></div>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success w-100" value="Login" />
                        <p class="text-muted mt-3"> Belum Memiliki Akun? <a href="<?= site_url('auth/register') ?>" class="text-success"> Register </a> </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>
