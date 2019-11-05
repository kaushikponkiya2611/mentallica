<body class="skin-blue">
    <!-- last my changes -->
    <!-- header logo: style can be found in header.less -->
    <?php require_once($_SERVER["DOCUMENT_ROOT"]."/views/header.php");?>
    <div class="myClass wrapper row-offcanvas row-offcanvas-left">
        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/views/left_part.php");?>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">                
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    404 Error Page
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Examples</a></li>
                    <li class="active">404 error</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
             
                <div class="error-page">
                    <h2 class="headline text-info"> 404</h2>
                    <div class="error-content">
                        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                        <p>
                            We could not find the page you were looking for. 
                            Meanwhile, you may <a href='<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>home/'>return to home</a> or try using the search form.
                        </p>
                        <form class='search-form'>
                            <div class='input-group'>
                                <input type="text" name="search" class='form-control' placeholder="Search"/>
                                <div class="input-group-btn">
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div><!-- /.input-group -->
                        </form>
                    </div><!-- /.error-content -->
                </div><!-- /.error-page -->

            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->
    <?php include('footer.php'); ?>

    <!-- jQuery 2.0.2 -->
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/AdminLTE/app.js" type="text/javascript"></script>

</body>