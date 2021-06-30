<div class="cat__top-bar">
    <!-- left aligned items -->
    <div class="cat__top-bar__left">
        <div class="cat__top-bar__logo">
            <a href="<?php echo base_url().'dashboard'; ?>">
                <?php $gambar_banner = $this->controller->jCfg['user']['gambar_banner'];?>
                <img src="<?php echo base_url()?>uploads/unitbisnis_brand/banner/<?php echo isset($gambar_banner)?$gambar_banner:'no_image.jpg';?>" height="50" alt="Amazon">
            </a>
        </div>
        <div class="cat__top-bar__item hidden-md-down margin-left-20 xs-hidden">
            <marquee scrollamount="10">
              <h5 class="text-left">
                <?php $jk = $this->controller->jCfg['user']['jenis_kelamin'];
                  if (isset($jk) && $jk=='PEREMPUAN') {
                    $jk_X = 'Ibu';
                  }else {
                    $jk_X = 'Bapak';
                  }
                ?>

                <strong >
                  Semangat Pagi <?php echo $jk_X ;?> <?php echo $this->controller->jCfg['user']['name'];?>, Akses anda adalah <?php echo $this->controller->jCfg['user']['groups'];?>
                </strong>
              </h5>
            </marquee>
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
        <div class="cat__top-bar__item mr-2">
            <div class="dropdown cat__top-bar__avatar-dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="cat__top-bar__avatar" href="javascript:void(0);">
                        <img src="<?php echo isset($this->controller->jCfg['user']['foto_profil'])?get_image(base_url()."uploads/personal/large/".$this->controller->jCfg['user']['foto_profil']):base_url('assets/common/img/temp/photos/no_image.jpg') ?>" alt="Alternative text to the image" style="height:100%" />
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="" role="menu">
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-user"></i>
                        <?php echo $this->controller->jCfg['user']['name'];?>
                        <small>
                            (<?php echo $this->controller->jCfg['user']['groups'];?>)
                        </small>
                    </a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-header">Home</div>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-circle-right"></i> <?php echo $this->controller->jCfg['user']['groups'];?></a>
          					<a class="dropdown-item" href="<?php echo base_url().'user/change-password'; ?>"><i class="dropdown-icon icmn-circle-right"></i> Ubah Password</a>
          					<div class="dropdown-divider"></div>
          					<a class="dropdown-item" href="<?php echo base_url(); ?>auth/logout"><i class="dropdown-icon icmn-exit"></i> Keluar</a>
                </ul>
            </div>
        </div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#speedtest"><i class="fa fa-globe"></i> Speedtest</button>
        <div class="cat__top-bar__item">
            <div class="cat__top-bar__menu-button cat__menu-right__action--menu-toggle">
                <i class="fa fa-bars"><!-- --></i>
            </div>
        </div>
    </div>
</div>
