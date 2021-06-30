<div class="cat__top-bar">
    <!-- left aligned items -->
    <div class="cat__top-bar__left">
        <div class="cat__top-bar__logo">
            <a href="<?php echo base_url() . 'dashboard'; ?>">
                <?php $gambar_banner = jCfg('user')['gambar_banner'] ?? 'http://erp.prioritasgroup.com/assets/front/common/img/logo-inverse.png'; ?>
                <img src="<?= $gambar_banner; ?>" height="50" alt="Prioritas Group">
            </a>
        </div>
        <div class="cat__top-bar__item hidden-md-down margin-left-20 xs-hidden">
            <marquee scrollamount="10">
                <h5 class="text-left">
                    <?php $jk = jCfg('user')['jenis_kelamin'] ?? null;
                    if (isset($jk) && $jk == 'PEREMPUAN') {
                        $jk_X = 'Ibu';
                    } else {
                        $jk_X = 'Bapak';
                    }
                    ?>

                    <strong class="text-white">
                        Semangat Pagi <?php echo $jk_X; ?> <?php echo jCfg('user')['name'] ?? ''; ?>
                        , Akses anda adalah <?php echo jCfg('user')['groups'] ?? ''; ?>
                    </strong>
                </h5>
            </marquee>

            <?php
            $mode_user = jCfg('user')['mode_user'];
            if (isset($mode_user) && $mode_user != 'NORMAL') {
                if (jCfg('user')['id_relasi_cabang'] != getDataById('users', jCfg('user')['id'], 'id_relasi_cabang')) {
                    $msg_mode_user = 'Anda masuk sebagai User ' . $mode_user . ' pada Unit Bisnis ' . getDataById('unitbisnis_nama', jCfg('user')['id_relasi_cabang'], 'nama_unitbisnis');
            ?>
                    <br>
                    <!-- <marquee direction="right" scrollamount="10"> -->
                    <h6 class="text-right">
                        <strong class="text-white blink">
                            <?php echo $msg_mode_user; ?>
                        </strong>
                    </h6>
                    <!-- </marquee> -->
            <?php
                }
            }
            ?>

            <div hidden class="cat__top-bar__search">
                <i class="icmn-search"></i>
                <input type="text" placeholder="Type to search...">
            </div>
        </div>
    </div>
    <!-- right aligned items -->
    <div class="cat__top-bar__right">
        <!-- <div class="cat__top-bar__item hidden-sm-down">
            <div class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="menu-notification-icon icmn-home"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="" role="menu">

                    <div class="cat__top-bar__activity">
                        <div class="cat__top-bar__activity__item">
                            <i class="cat__top-bar__activity__icon icmn-star-full"></i>
                            <div class="cat__top-bar__activity__inner">
                                <div class="cat__top-bar__activity__title">
                                    <span class="pull-right">now</span>
                                    <a href="javascript: void(0);">Update Status: <span class="badge badge-danger">New</span></a>
                                </div>
                                <div class="cat__top-bar__activity__descr">
                                    Failed to get available update data. To ensure the proper functioning of your application, update now.
                                </div>
                            </div>
                        </div>
                        <div class="cat__top-bar__activity__item">
                            <i class="cat__top-bar__activity__icon icmn-stack"></i>
                            <div class="cat__top-bar__activity__inner">
                                <div class="cat__top-bar__activity__title">
                                    <span class="pull-right">24 min ago</span>
                                    <a href="javascript: void(0);">Income: <span class="badge badge-default">$299.00</span></a>
                                </div>
                                <div class="cat__top-bar__activity__descr">
                                    Failed to get available update data. To ensure the proper functioning of your application, update now.
                                </div>
                            </div>
                        </div>
                        <div class="cat__top-bar__activity__item">
                            <i class="cat__top-bar__activity__icon icmn-list"></i>
                            <div class="cat__top-bar__activity__inner">
                                <div class="cat__top-bar__activity__title">
                                    <span class="pull-right">30 min ago</span>
                                    <a href="javascript: void(0);">Inbox Message</a>
                                </div>
                                <div class="cat__top-bar__activity__descr">
                                    From: <a href="javascript: void(0);">David Bowie</a>
                                </div>
                            </div>
                        </div>
                        <div class="cat__top-bar__activity__item">
                            <i class="cat__top-bar__activity__icon icmn-home"></i>
                            <div class="cat__top-bar__activity__inner">
                                <div class="cat__top-bar__activity__title">
                                    <span class="pull-right">now</span>
                                    <a href="javascript: void(0);">Update Status: <span class="badge badge-primary">New</span></a>
                                </div>
                                <div class="cat__top-bar__activity__descr">
                                    Failed to get available update data. To ensure the proper functioning of your application, update now.
                                </div>
                            </div>
                        </div>
                        <div class="cat__top-bar__activity__item">
                            <i class="cat__top-bar__activity__icon icmn-loop"></i>
                            <div class="cat__top-bar__activity__inner">
                                <div class="cat__top-bar__activity__title">
                                    <span class="pull-right">24 min ago</span>
                                    <a href="javascript: void(0);">Income: <span class="badge badge-warning">$299.00</span></a>
                                </div>
                                <div class="cat__top-bar__activity__descr">
                                    Failed to get available update data. To ensure the proper functioning of your application, update now.
                                </div>
                            </div>
                        </div>
                        <div class="cat__top-bar__activity__item">
                            <i class="cat__top-bar__activity__icon icmn-cog cat__core__spin-delayed--pseudo-selector"></i>
                            <div class="cat__top-bar__activity__inner">
                                <div class="cat__top-bar__activity__title">
                                    <span class="pull-right">30 min ago</span>
                                    <a href="javascript: void(0);">Inbox Message</a>
                                </div>
                                <div class="cat__top-bar__activity__descr">
                                    From: <a href="javascript: void(0);">David Bowie</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </ul>
            </div>
        </div> -->
        <style>
            .bell {
                position: relative;
                padding: 10px;
                border: 1px solid #e0e0e0;
                border-radius: 50%;
            }

            .bell:hover {
                background: #e0e0e0;
                color: #FB434A
            }

            .bell .badge {
                position: absolute;
                top: -5px;
                right: -15px;

            }
        </style>
        <style>
            .blink {
                animation: blink-animation 1s steps(5, start) infinite;
                -webkit-animation: blink-animation 1s steps(5, start) infinite;
            }

            @keyframes blink-animation {
                to {
                    visibility: hidden;
                }
            }

            @-webkit-keyframes blink-animation {
                to {
                    visibility: hidden;
                }
            }
        </style>
        <?php
        // dd(CheckAkses('pemesanananalist', 2));
        // if(CheckAkses('pemesanananalist', 2)) {
        if (false) {
        ?>
            <a href="<?= base_url('pemesanan/pemesanananalist/add'); ?>">
                <div class="cat__top-bar__item mr-2 bell">
                    <span class="badge badge-danger"><?= countRekap(); ?></span>
                    <i class="fa fa-bell"></i>
                </div>
            </a>
        <?php
        }
        ?>
        <div class="cat__top-bar__item mr-2">
            <div class="dropdown cat__top-bar__avatar-dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="cat__top-bar__avatar" href="javascript:void(0);">
                        <img src="<?php echo isset(jCfg('user')['foto_profil']) ? get_image(base_url() . "uploads/personal/large/" . jCfg('user')['foto_profil']) : base_url('assets/common/img/temp/photos/no_image.jpg') ?>" alt="Alternative text to the image" style="height:100%" />
                    </span>
                </a>
                <input type="hidden" id="id_group_level" name="id_group_level" value="<?php echo jCfg('user')['id_group_level']; ?>">
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="" role="menu">
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-user"></i>
                        <?php echo jCfg('user')['name']; ?>
                        <small>
                            (<?php echo jCfg('user')['groups']; ?>)
                        </small>
                    </a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-header">Home</div>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-circle-right"></i> <?php echo jCfg('user')['groups']; ?></a>
                    <a class="dropdown-item" href="<?php echo base_url() . 'user/change-password'; ?>"><i class="dropdown-icon icmn-circle-right"></i> Ubah Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onclick="location.reload(true);"><i class="fa fa-refresh"></i> Hard Reload (shift+f5)</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>auth/logout"><i class="dropdown-icon icmn-exit"></i> Keluar</a>
                </ul>
            </div>
        </div>
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#speedtest"><i class="fa fa-globe"></i> Speedtest</button> -->
        <!-- <div class="cat__top-bar__item">
            <div class="cat__top-bar__menu-button cat__menu-right__action--menu-toggle">
                <i class="fa fa-bars"></i>
            </div>
        </div> -->
    </div>
</div>