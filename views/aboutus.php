<body class="skin-blue">
    <!-- header logo: style can be found in header.less -->
    <?php require_once($_SESSION['APP_PATH']."views/header.php");?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php //require_once($_SESSION['APP_PATH']."views/left_part.php");?>

        <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="">
                <!-- Main content -->
                <section class="">
                    
                    <div class="container">
					<div class="mainbox-boder">
                        <!-- Content Header (Page header) -->
                        <!-- <section class="content-header">
                            <ol class="breadcrumb">
                                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            </ol>
                        </section> -->
                        <!-- Page Header -->
						<div class="row">
						<div class="banner-and-text">
                           <?php 
					$sql4 = mysql_query("SELECT * FROM tbl_cms where id='1'");
					$result4 = mysql_fetch_assoc($sql4); 
				?>
							<div class="col-md-12">
								<div class="artists-favorite-text">
									<h1><?php echo $result4['title']; ?></h1>
									<?php echo $result4['description']; ?>
								</div>
							</div>
							<div class="clear"></div>
							</div>
						</div>
                       
					</div>
					
					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
    </div>
	<!-- ./wrapper -->

	<?php include('footernew.php'); ?>
 
	
   
</body>