<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;">
                        <?php echo image_asset('user-13.jpg', array('class'=>'media-object')); ?>
                    </a>
                </div>
                <div class="info">
                    <?php echo $this->controller->jCfg['user']['name'];?>
                    <small>
                        <?php echo $this->controller->jCfg['user']['level'];
                        //debugCode($this->jCfg['user']);
                        ?>
                    </small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
            <?php
                if($this->controller->jCfg['user']['level'] != "grader"){
                    //debugCode($this->controller->jCfg['menu']);
                    dnmcMenu($this->controller->jCfg['menu'],true);
                }
            ?>
        <ul class="nav">
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
        </ul>

        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
