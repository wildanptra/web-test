<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Prioritas ERP - Version 1.0</title>

    <link href="<?php echo asset_url('favicon.144x144.png','common/img') ?>" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="<?php echo asset_url('favicon.114x114.png','common/img') ?>" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="<?php echo asset_url('favicon.72x72.png','common/img') ?>" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="<?php echo asset_url('favicon.57x57.png','common/img') ?>" rel="apple-touch-icon" type="image/png">
    <link href="<?php echo asset_url('favicon.png','common/img') ?>" rel="icon" type="image/png">
    <link href="favicon.ico" rel="shortcut icon">

    <!-- HTML5 shim and Respond.js for < IE9 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		{_meta}

  <!-- VENDORS -->
    <!-- v2.0.0 -->
    <?php  echo vendors_asset('bootstrap/css/bootstrap.min.css', 'css');?>
    <?php  echo vendors_asset('perfect-scrollbar/css/perfect-scrollbar.css', 'css');?>
    <?php  echo vendors_asset('ladda/dist/ladda-themeless.min.css', 'css');?>
    <?php  echo vendors_asset('bootstrap-select/dist/css/bootstrap-select.min.css', 'css');?>
    <?php  echo vendors_asset('select2/dist/css/select2.min.css', 'css');?>
    <?php  echo vendors_asset('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 'css');?>
    <?php  echo vendors_asset('fullcalendar/dist/fullcalendar.min.css', 'css');?>
    <?php  echo vendors_asset('bootstrap-sweetalert/dist/sweetalert.css', 'css');?>
    <?php  echo vendors_asset('summernote/dist/summernote.css', 'css');?>
    <?php  echo vendors_asset('owl.carousel/dist/assets/owl.carousel.min.css', 'css');?>
    <?php  echo vendors_asset('ionrangeslider/css/ion.rangeSlider.css', 'css');?>
    <?php  echo vendors_asset('datatables/media/css/dataTables.bootstrap4.css', 'css');?>
    <?php  echo vendors_asset('c3/c3.min.css', 'css');?>
    <?php  echo vendors_asset('chartist/dist/chartist.min.css', 'css');?>
    <?php  echo vendors_asset('nprogress/nprogress.css', 'css');?>
    <?php  echo vendors_asset('jquery-steps/demo/css/jquery.steps.css', 'css');?>
    <?php  echo vendors_asset('dropify/dist/css/dropify.min.css', 'css');?>
    <?php  echo vendors_asset('font-linearicons/style.css', 'css');?>
    <?php  echo vendors_asset('font-icomoon/style.css', 'css');?>
    <?php  echo vendors_asset('font-awesome/css/font-awesome.min.css', 'css');?>
    <?php  echo vendors_asset('cleanhtmlaudioplayer/src/player.css', 'css');?>
    <?php  echo vendors_asset('cleanhtmlvideoplayer/src/player.css', 'css');?>


    <!-- CLEAN UI ADMIN TEMPLATE MODULES-->
    <!-- v2.0.0 -->
    <link rel="stylesheet" type="text/css" href="<?=load_asset('core/common/core.cleanui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=load_asset('vendors/common/vendors.cleanui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=load_asset('layouts/common/layouts-pack.cleanui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=load_asset('themes/common/themes.cleanui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=load_asset('menu-left/common/menu-left.cleanui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=load_asset('menu-right/common/menu-right.cleanui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=load_asset('top-bar/common/top-bar.cleanui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=load_asset('footer/common/footer.cleanui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=load_asset('pages/common/pages.cleanui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=load_asset('ecommerce/common/ecommerce.cleanui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=load_asset('apps/common/apps.cleanui.css');?>">
    <script src="<?=load_asset('menu-left/common/menu-left.cleanui.js');?>"></script>
    <script src="<?=load_asset('menu-right/common/menu-right.cleanui.js');?>"></script>

    <!-- <?php //echo css_asset('source/helpers/fonts.css'); ?> -->

		<!-- PARTIAL CSS FILE -->
		{_styles}
	</head>
<body class="cat__config--vertical cat__menu-left--colorful<?php if ($this->controller->jCfg['is_login'] == 0): ?> single-page <?php endif; ?>">
		<?php if ($this->controller->jCfg['is_login'] == 1): ?>
			<!-- BEGIN SIDEBAR -->
				{sidebar}
			<!-- END SIDEBAR -->
			<!-- BEGIN HEADER -->
				{header}
			<!-- END HEADER -->
			<!-- MAIN PANEL -->
			<section class="page-content">
				<div class="page-content-inner">
					<!-- MAIN CONTENT -->
						<?php
						$current_url = str_replace(base_url(), '', current_url());
						?>
						<input type="hidden" id="baseURL" value="<?php echo base_url(); ?>" data-current="<?=$current_url;?>">
						{content}
					<!-- END MAIN CONTENT -->
				</div>
			</section>
			<!-- END MAIN PANEL -->
			<!-- PAGE FOOTER -->
				{footer}
			<!-- END PAGE FOOTER -->
			<div class="main-backdrop"><!-- --></div>
		<?php else: ?>
			{content}
		<?php endif; ?>

		<!-- Vendors Scripts -->
		<!-- v1.0.0 -->

	    <?php  echo vendors_asset('jquery/dist/jquery.min.js');?>
	    <?php  echo vendors_asset('popper.js/dist/umd/popper.js');?>
	    <?php  echo vendors_asset('jquery-ui/jquery-ui.min.js');?>
	    <?php  echo vendors_asset('bootstrap/js/bootstrap.min.js');?>
	    <?php  echo vendors_asset('jquery-mousewheel/jquery.mousewheel.min.js');?>
	    <?php  echo vendors_asset('perfect-scrollbar/js/perfect-scrollbar.jquery.js');?>
	    <?php  echo vendors_asset('spin.js/spin.js');?>
	    <?php  echo vendors_asset('ladda/dist/ladda.min.js');?>
	    <?php  echo vendors_asset('bootstrap-select/dist/js/bootstrap-select.min.js');?>
	    <?php  echo vendors_asset('select2/dist/js/select2.full.min.js');?>
	    <?php  echo vendors_asset('html5-form-validation/dist/jquery.validation.min.js');?>
	    <?php  echo vendors_asset('jquery-typeahead/dist/jquery.typeahead.min.js');?>
	    <?php  echo vendors_asset('jquery-mask-plugin/dist/jquery.mask.min.js');?>
	    <?php  echo vendors_asset('autosize/dist/autosize.min.js');?>
	    <?php  echo vendors_asset('bootstrap-show-password/bootstrap-show-password.min.js');?>
	    <?php  echo vendors_asset('moment/min/moment.min.js');?>
	    <?php  echo vendors_asset('eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');?>
	    <?php  echo vendors_asset('fullcalendar/dist/fullcalendar.min.js');?>
	    <?php  echo vendors_asset('bootstrap-sweetalert/dist/sweetalert.min.js');?>
	    <?php  echo vendors_asset('remarkable-bootstrap-notify/dist/bootstrap-notify.min.js');?>
	    <?php  echo vendors_asset('summernote/dist/summernote.min.js');?>
	    <?php  echo vendors_asset('owl.carousel/dist/owl.carousel.min.js');?>
	    <?php  echo vendors_asset('ionrangeslider/js/ion.rangeSlider.min.js');?>
	    <?php  echo vendors_asset('nestable/jquery.nestable.js');?>
	    <?php  echo vendors_asset('datatables/media/js/jquery.dataTables.min.js');?>
	    <?php  echo vendors_asset('datatables/media/js/dataTables.bootstrap4.js');?>
	    <?php  echo vendors_asset('datatables-fixedcolumns/js/dataTables.fixedColumns.js');?>
	    <?php  echo vendors_asset('datatables-responsive/js/dataTables.responsive.js');?>
	    <?php  echo vendors_asset('editable-table/mindmup-editabletable.js');?>
	    <?php  echo vendors_asset('d3/d3.min.js');?>
	    <?php  echo vendors_asset('c3/c3.min.js');?>
	    <?php  echo vendors_asset('chartist/dist/chartist.min.js');?>
	    <?php  echo vendors_asset('peity/jquery.peity.min.js');?>
	    <?php  echo vendors_asset('chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js');?>
	    <?php  echo vendors_asset('jquery-countTo/jquery.countTo.js');?>
	    <?php  echo vendors_asset('nprogress/nprogress.js');?>
	    <?php  echo vendors_asset('jquery-steps/build/jquery.steps.min.js');?>
	    <?php  echo vendors_asset('chart.js/dist/Chart.bundle.min.js');?>
	    <?php  echo vendors_asset('dropify/dist/js/dropify.min.js');?>
	    <?php  echo vendors_asset('cleanhtmlaudioplayer/src/jquery.cleanaudioplayer.js');?>
	    <?php  echo vendors_asset('cleanhtmlvideoplayer/src/jquery.cleanvideoplayer.js');?>
		<!-- js files specific to the page -->
		{_scripts}
<!-- 
		<script type="text/javascript">
			$(function () {
				$(".left-menu-list-active.menus").parents('.menus').addClass('left-menu-list-opened');
				$(".left-menu-list-active.menus").parents('ul.left-menu-list').attr('style','display:block;');
			});

			$('.datepicker').each(function(){
				$(this).datetimepicker({
		            widgetPositioning: {
		                horizontal: 'left'
		            },
		            icons: {
		                time: "fa fa-clock-o",
		                date: "fa fa-calendar",
		                up: "fa fa-arrow-up",
		                down: "fa fa-arrow-down"
		            },
		            format: 'YYYY-MM-DD'
		        });
			});

			$(".chosen").chosen({
				// disable_search_threshold: 10,
				no_results_text: "Oops, nothing found!",
				width: "100%",
				height: "110%",
			});

			$('.selectpicker').selectpicker();
		</script> -->
	</body>
</html>
