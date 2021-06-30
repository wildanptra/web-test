<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Predator v5 | Prioritas Group</title>

    {_meta}

    <link href="<?= load_asset('core/common/img/favicon.ico'); ?>" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
    <!-- VENDORS -->
    <!-- v2.0.0 -->
    <?php echo vendors_asset('bootstrap-datepicker/css/datepicker.css', 'css'); ?>
    <?php echo vendors_asset('bootstrap-select/dist/css/bootstrap-select.min.css', 'css'); ?>
    <?php echo vendors_asset('bootstrap/css/bootstrap.min.css', 'css'); ?>
    <?php echo vendors_asset('datatables/media/css/dataTables.bootstrap4.css', 'css'); ?>
    <?php echo vendors_asset('datatables-custom/css/dataTables.searchHighlight.css', 'css'); ?>
    <?php echo vendors_asset('nprogress/nprogress.css', 'css'); ?>
    <?php echo vendors_asset('select2/dist/css/select2.min.css', 'css'); ?>
    <!-- <?php  //echo vendors_asset('fullcalendar/dist/fullcalendar.min.css', 'css');
            ?> -->
    <?php echo vendors_asset('limonte-sweetalert2/sweetalert2.min.css', 'css'); ?>
    <!-- <?php  //echo vendors_asset('summernote/dist/summernote.css', 'css');
            ?> -->
    <!-- <?php  //echo vendors_asset('owl.carousel/dist/assets/owl.carousel.min.css', 'css');
            ?> -->
    <!-- <?php  //echo vendors_asset('c3/c3.min.css', 'css');
            ?> -->
    <?php  //echo vendors_asset('chartist/dist/chartist.min.css', 'css');
    ?>
    <?php echo vendors_asset('font-awesome/css/font-awesome.min.css', 'css'); ?>
    <?php echo vendors_asset('chosen/chosen.css', 'css'); ?>
    <!-- <?php  //echo vendors_asset('ionrangeslider/css/ion.rangeSlider.css', 'css');
            ?> -->
    <?php echo vendors_asset('ladda/dist/ladda-themeless.min.css', 'css'); ?>
    <?php echo vendors_asset('perfect-scrollbar/css/perfect-scrollbar.css', 'css'); ?>
    <?php echo vendors_asset('lightbox/css/lightbox.css', 'css'); ?>


    <!-- CLEAN UI ADMIN TEMPLATE MODULES-->
    <!-- v2.0.0 -->
    <link rel="stylesheet" type="text/css" href="<?= load_asset('core/common/core.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= load_asset('vendors/common/vendors.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= load_asset('vendors/jquery-steps/jquery-steps.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= load_asset('layouts/common/layouts-pack.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= load_asset('themes/common/themes.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= load_asset('menu-left/common/menu-left.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= load_asset('menu-right/common/menu-right.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= load_asset('top-bar/common/top-bar.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= load_asset('footer/common/footer.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= load_asset('pages/common/pages.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= load_asset('ecommerce/common/ecommerce.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= load_asset('apps/common/apps.cleanui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/front/common/css/source/helpers/fonts.css'); ?>">
    <style type="text/css">
        body.cat__theme--red .cat__top-bar {
            background: #d24667;
            border-bottom-color: #d24667;
        }

        body.cat__theme--red .cat__menu-left__icon {
            color: #fb434a;
        }

        .table tr td {
            vertical-align: middle !important;
        }

        @media(max-width:767px) {
            .xs-hidden {
                display: none;
            }
        }

        @media(min-width:768px) {
            .cat__top-bar__logo {
                margin-right: 20px;
            }
        }

        @media(min-width:992px) {}

        @media(min-width:1200px) {}

        .bg-primary {
            background: #D24667 !important;
            color: white;
        }

        .month-wrapper thead {
            font-size: 12px !important;
        }

        .blockUI.blockOverlay {
            z-index: 10000 !important;
        }

        .blockUI.blockMsg {
            z-index: 10011 !important;
        }
    </style>
    {_styles}
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/css/bootstrap4-chosen.css'); ?>">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-149471988-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-149471988-1');
    </script>
</head>

<body class="cat__config--vertical cat__menu-left--colorful cat__theme--red" data-gs-domain="<?= $this->config->item('gs_domain'); ?>">
    <?php
    $current_url = str_replace(base_url(), '', current_url());
    ?>
    <input type="hidden" id="baseURL" value="<?php echo base_url(); ?>" data-current="<?= $current_url; ?>">
    {sidebar}
    {header}
    <div class="cat__content">
        <!-- begin breadcrumb -->
        <?php get_breadcrumb(_breadcrumb()); ?>
        <!-- end breadcrumb -->
        {content}
        <div class="cat__footer">
            {footer}
        </div>
    </div>
    <?php echo vendors_asset('jquery/dist/jquery.min.js'); ?>
    <script>
        function base_url(path = '') {
            let baseURL = $('#baseURL').val();
            return baseURL + path;
        }

        function current_url(full = false) {
            if (full) {
                return '<?= current_url(); ?>'
            } else {
                return '<?= str_replace(base_url(), '', current_url()); ?>'
            }
        }

        function uri_segment(no) {
            let uri = current_url().split('/');
            return uri[no - 1];
        }
    </script>
    <?php echo vendors_asset('popper.js/dist/umd/popper.js'); ?>
    <?php echo vendors_asset('jquery-ui/jquery-ui.min.js'); ?>
    <?php echo vendors_asset('bootstrap/js/bootstrap.min.js'); ?>
    <?php echo vendors_asset('jquery-mousewheel/jquery.mousewheel.min.js'); ?>
    <?php echo vendors_asset('perfect-scrollbar/js/perfect-scrollbar.jquery.js'); ?>
    <!-- <?php  //echo vendors_asset('spin.js/spin.js');
            ?> -->
    <?php echo vendors_asset('ladda/dist/ladda.min.js'); ?>
    <?php echo vendors_asset('bootstrap-select/dist/js/bootstrap-select.min.js'); ?>
    <?php echo vendors_asset('select2/dist/js/select2.full.min.js'); ?>
    <?php echo vendors_asset('html5-form-validation/dist/jquery.validation.min.js'); ?>
    <?php echo vendors_asset('html5-form-validation/dist/jquery.validate.min.js'); ?>
    <?php echo vendors_asset('html5-form-validation/dist/additional-methods.min.js'); ?>
    <?php echo vendors_asset('jquery-typeahead/dist/jquery.typeahead.min.js'); ?>
    <?php echo vendors_asset('jquery-mask-plugin/dist/jquery.mask.min.js'); ?>
    <?php echo vendors_asset('autosize/dist/autosize.min.js'); ?>
    <!-- <?php  //echo vendors_asset('bootstrap-show-password/bootstrap-show-password.min.js');
            ?> -->
    <?php echo vendors_asset('moment/min/moment.min.js'); ?>
    <?php echo vendors_asset('bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>
    <!-- <?php  //echo vendors_asset('fullcalendar/dist/fullcalendar.min.js');
            ?> -->
    <?php echo vendors_asset('limonte-sweetalert2/sweetalert2.min.js'); ?>
    <?php echo vendors_asset('remarkable-bootstrap-notify/dist/bootstrap-notify.min.js'); ?>
    <!-- <?php  //echo vendors_asset('summernote/dist/summernote.min.js');
            ?> -->
    <!-- <?php  //echo vendors_asset('owl.carousel/dist/owl.carousel.min.js');
            ?> -->
    <!-- <?php  //echo vendors_asset('ionrangeslider/js/ion.rangeSlider.min.js');
            ?> -->
    <!-- <?php  //echo vendors_asset('nestable/jquery.nestable.js');
            ?> -->
    <?php echo vendors_asset('datatables-custom/js/dataTables.searchHighlight.min.js', 'js') ?>
    <?php echo vendors_asset('datatables-custom/js/jquery.highlight.js', 'js') ?>
    <?php echo vendors_asset('datatables/media/js/jquery.dataTables.min.js'); ?>
    <?php echo vendors_asset('datatables/media/js/dataTables.bootstrap4.js'); ?>
    <?php echo vendors_asset('datatables-fixedcolumns/js/dataTables.fixedColumns.js'); ?>
    <?php echo vendors_asset('datatables-responsive/js/dataTables.responsive.js'); ?>
    <?php echo vendors_asset('editable-table/mindmup-editabletable.js'); ?>
    <!-- <?php  //echo vendors_asset('d3/d3.min.js');
            ?> -->
    <!-- <?php  //echo vendors_asset('c3/c3.min.js');
            ?> -->
    <!-- <?php  //echo vendors_asset('chartist/dist/chartist.min.js');
            ?> -->
    <?php echo vendors_asset('peity/jquery.peity.min.js'); ?>
    <!-- <?php  //echo vendors_asset('chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js');
            ?> -->
    <!-- <?php  //echo vendors_asset('jquery-countTo/jquery.countTo.js');
            ?> -->
    <?php echo vendors_asset('nprogress/nprogress.js'); ?>
    <!-- <?php  //echo vendors_asset('chart.js/dist/Chart.bundle.min.js');
            ?> -->
    <?php echo vendors_asset('chosen/chosen.jquery.js', 'js'); ?>
    <?php echo vendors_asset('lightbox/js/lightbox-2.6.min.js', 'js'); ?>

    <?php echo helpers_asset('app_helpers.js'); ?>

    <script src="<?= asset_url('plugins/jquery.BlockUI.js'); ?>"></script>
    <script type="text/javascript">
        function blockUI(arg = '') {
            if (arg == 'stop') {
                $.unblockUI();
            } else {
                if (arg != 'stop' && arg != '') {
                    $.blockUI({
                        message: '<div style="font-size: 18px; padding: 5px"><i class="fa fa-refresh fa-spin"></i> ' + arg + '</div>'
                    });

                } else {

                    $.blockUI({
                        message: '<div style="font-size: 18px; padding: 5px"><i class="fa fa-refresh fa-spin"></i> Silahkan Tunggu...</div>'
                    });
                }
            }
        }

        function swalOpt(title, text = '', type = '', dataOpt = {
            showCancelButton: false
        }, btnConfirm = 'OK', btnCancel = 'Cancel') {
            let opt = {
                title: title,
                text: text,
                type: type,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                showCancelButton: dataOpt.showCancelButton,
                cancelButtonText: btnCancel,
                confirmButtonText: btnConfirm
            };
            return opt;
        }
    </script>
    <script src="<?= load_asset('menu-left/common/menu-left.cleanui.js'); ?>"></script>
    <script src="<?= load_asset('menu-right/common/menu-right.cleanui.js'); ?>"></script>

    {_scripts}
    <script type="text/javascript">
        // $(".chosen").chosen();
        // $('link[href="http://prioritas-group.co.id/assets/vendors/datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css"]').remove();
        $('.dt-button').each(function() {
            $(this).addClass('btn btn-primary btn-sm');
            $(this).removeClass('.dt-button');
        });

        $('.datepicker, .tanggal_picker').each(function() {
            $(this).datepicker({
                todayHighlight: true,
                clearBtn: true,
                autoclose: true,
                widgetPositioning: {
                    horizontal: 'left'
                },
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                uiLibrary: 'bootstrap4',
                format: 'dd-mm-yyyy'
            }).on('hide', function(e) {
                e.stopPropagation();
            });
        });

        $(".chosen").chosen({
            // disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%",
            height: "110%",
        });

        function post(url, callback) {
            $.ajax({
                url: url,
                error: function() {
                    callback('ERROR');
                },
                success: function(res) {
                    callback(res);
                },
                timeout: 10
            });
        }

        $(document).on('keydown', 'body', function(e) {
            var charCode = (e.which) ? e.which : event.keyCode;

            if (charCode == 13) //ENTER
            {
                return false;
            }
        });
    </script>

    <script>
        if (location.origin.indexOf("https") != -1) {
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/sw.js').then(function(registration) {
                        // Registration was successful
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    }, function(err) {
                        // registration failed :(
                        console.log('ServiceWorker registration failed: ', err);
                    });
                });
            }
        }

        $('[reset-filter]').click(function() {
            let target = $(this).data('target');
            let form = $(target);
            form[0].reset();
            $('.chosen').trigger('chosen:updated');
        })
    </script>
</body>
<script>
    // $(window).on('unload', function(){
    //
    //     $.post($('#baseURL').val()+'auth/Auth/logout',function(){
    //         return true;
    //     })
    //
    // });

    // if('serviceWorker' in navigator) {
    //   navigator.serviceWorker
    //            .register('/sw.js')
    //            .then(function() { console.log("Service Worker Registered"); });
    // }
</script>

<!-- Firebase -->
<!-- Firebase -->
<script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-analytics.js"></script>

<script>
    if (location.origin.indexOf("https") != -1) {
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/firebase-messaging-sw.js')
                .then(function(registration) {
                    console.log('Registration successful, scope is:', registration.scope);
                }).catch(function(err) {
                    console.log('Service worker registration failed, error:', err);
                });
        }
    }

    // Your web app's Firebase configuration
    firebase.initializeApp({
        apiKey: "AIzaSyBbEMOwJVLx6iZhf58PHLkDzT1dFlc_Tns",
        authDomain: "prioritasgroup.firebaseapp.com",
        databaseURL: "https://prioritasgroup.firebaseio.com",
        projectId: "prioritasgroup",
        storageBucket: "prioritasgroup.appspot.com",
        messagingSenderId: "273247276696",
        appId: "1:273247276696:web:eb37e829523299c5918aed",
        measurementId: "G-S9PSWNPHLK"
    });

    firebase.analytics();

    const messaging = firebase.messaging();

    function InitialFirebaseMessaging() {
        messaging.requestPermission().then(() => {

            return messaging.getToken();

        }).then((Token) => {

            SendTokenToServer(Token);

        });
    }

    function SendTokenToServer(Token) {
        console.log('SendTokenToServer :' + Token);
    }

    messaging.onMessage((payload) => {
        console.log(payload);
        if (Notification.permission == 'granted') {
            const notificationTitle = payload.notification.title;
            const notificationOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon
            };

            let notification = new Notification(notificationTitle, notificationOptions)
            notification.onclick(ev => {
                ev.preventDefault();
                window.open(payload.notification.click_action, '_blank');;
                notification.close();
            })

        }
    });

    messaging.onTokenRefresh(() => {
        messaging.getToken()
            .then((newToken) => {
                SendTokenToServer(newToken)
            }).catch((reason) => {
                console.log(reason)
            })
    })

    InitialFirebaseMessaging();
    
</script>