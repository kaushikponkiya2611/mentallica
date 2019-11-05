<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $_SESSION['po_userses']['flc_usrlogin_image'];?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Hello, <?php echo $_SESSION['po_userses']['flc_usrlogin_first_nm'];?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <?php if($_SESSION['po_userses']['flc_usrlogin_type'] == 1):?>
            <li class="<?php echo $_GET['pid'] == '' || $_GET['pid'] == 'home' ? "active" : "";?>">
                <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>home/">
                    <i class="fa fa-dashboard"></i> <span>Home</span>
                </a>
            </li>
            <li class="<?php echo $_GET['pid'] == 'imgupload' ? "active" : "";?>">
                <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>imgupload/">
                    <i class="fa fa-dashboard"></i> <span>Image Upload</span>
                </a>
            </li>
            <?php endif; ?>
            <li class="treeview <?php echo $_GET['pid'] == 'profile' ? "active" : "";?>">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Your profile</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>profile/"><i class="fa fa-angle-double-right"></i> View / Edit profile</a></li>
                    <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>logout/"><i class="fa fa-angle-double-right"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>