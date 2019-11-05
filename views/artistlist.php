<body class="skin-blue">
    <div class="container">
        <div class="row blue-border-main">
            <!-- header logo: style can be found in header.less -->
            <?php require_once($_SESSION['APP_PATH'] . "views/header.php"); ?>
            <div class="wrapper row-offcanvas row-offcanvas-left">
                <?php //require_once($_SESSION['APP_PATH']."views/left_part.php");?>
                <!-- Right side column. Contains the navbar and content of the page -->
                <aside class="right-side strech">
                    <!-- Main content -->
                    <section class="">
                        <?php /* ?>
                          <!-- row -->
                          <div class="row">
                          <?php foreach ($controller_class -> getuserimages as $key => $imgsdata):?>
                          <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                          <?php if($_SESSION['po_userses']['flc_usrlogin_plan'] == 3):?>
                          <a href="<?php echo $_SESSION['SITE_NAME']."upload/images/".$imgsdata['image']; ?>" class="example-image-link thumb" data-lightbox="example-set" data-title="<?php echo $imgsdata['image_text'];?>">
                          <img src="<?php echo $_SESSION['SITE_NAME']."upload/images/300/".$imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                          </a>
                          <?php else: ?>
                          <img src="<?php echo $_SESSION['SITE_NAME']."upload/images/300/".$imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                          <?php endif;?>
                          </div>
                          <?php endforeach; ?>
                          </div><!-- /.row -->
                          <?php */ ?>
                        <div class="container">
                            <div class="mainbox-boder no_brd">
                                <!-- Content Header (Page header) -->
                                <section class="content-header">
                                    <ol class="breadcrumb">
                                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                                    </ol>
                                </section>
                                <!-- Page Header -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h1 class="page-header">Artist
                                            <small>Select any category to view artist list.</small>
                                        </h1>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <div class="row">
                                    <div class="col-xs-12 col-md-3 wi30">
                                        <div class="box box-success mgt0">
                                            <div class="box-header pdb_0">
                                                <h3 class="box-title w16">Advance Search</h3>
                                            </div><!-- /.box-header -->
                                            <form role="form" action="" method="post" name="frm_search_artist" id="frm_search_artist">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">First Name</label>
                                                        <input type="text" class="form-control" name="src_first_name" id="src_first_name" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Last Name</label>
                                                        <input type="text" class="form-control" name="src_last_name" id="src_first_name" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Gender</label>
                                                        <select class="form-control" name="src_gender" id="src_gender">
                                                            <option value="">Select Gender</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email Address</label>
                                                        <input type="text" class="form-control" name="src_email" id="src_email" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Country</label>
                                                        <select name="src_country" id="src_country" class="form-control" >
                                                            <option value="">Select Country</option>
                                                            <?php
                                                            $allcountry = $controller_class->getAllCountryList();
                                                            foreach ($allcountry as $key => $countrylist) :
                                                                ?>
                                                                <option value="<?php echo $countrylist['Id']; ?>"><?php echo $countrylist['countryName']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">State</label>
                                                        <select name="src_state" id="src_state" class="form-control" >
                                                            <option value="">Select State</option>
                                                            <?php
                                                            $allstate = $controller_class->getStateListByCountry($controller_class->userdetail['country']);
                                                            foreach ($allstate as $key => $stlist) :
                                                                ?>
                                                                <option value="<?php echo $stlist['id']; ?>"><?php echo $stlist['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div><!-- /.box-body -->
                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-primary" id="btn_search_artist" name="btn_search_artist">Search Artist</button>
                                                    <button type="button" class="btn btn-primary" id="btn_search_hide" name="btn_search_hide">Hide</button>
                                                    <button type="button" class="btn btn-primary" id="btn_search_show" name="btn_search_show">Search Artist <!--<i class="fa fa-search"></i> --></button>
                                                </div>
                                            </form>
                                        </div>
                                        <!--Artist Mobile View Start-->
                                        <div class="mobileview-artist">
                                            <?php
                                            //print_r($_REQUEST); die;
                                            $qrya = mysql_query("SELECT aid FROM tbl_suggested_artist where cid=" . $_REQUEST['workid']);
                                            $arraysel = array();
                                            while ($dataq = mysql_fetch_array($qrya)) {
                                                $arraysel[] = $dataq['aid'];
                                            }
                                            //print_r($arraysel); die;
                                            $modcnt = 0;
                                            foreach ($controller_class->artistlistbycategory as $key => $catdata):
                                                if (!in_array($catdata['id'], $arraysel)) {
                                                    continue;
                                                }
                                                if (is_file($_SESSION['SITE_IMG_PATH'] . "artist/" . $catdata['image'])) {
                                                    $userimage = $_SESSION['FRNT_DOMAIN_NAME'] . "upload/artist/" . $catdata['image'];
                                                } else {
                                                    $userimage = $_SESSION['FRNT_DOMAIN_NAME'] . "img/no-profile-picture-icon-620x389.jpg";
                                                }
                                                ?>
                                                <!--Select Artist Start-->
                                                <div class="artistlist-rightbox serch-box">
                                                    <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'] . "artistpreview/" . $catdata['username'] . "/" . $_GET['workid']; ?>">
                                                        <div class="col-xs-12"  style="background-image: url('<?php echo $userimage; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;">&nbsp;</div>
                                                        <div class="cleardiv"></div>
                                                        <h3> <?php echo $catdata['first_name'] . " " . $catdata['last_name']; ?></h3>
                                                    </a>
                                                </div>
                                                <!--Select Artist End-->
                                            <?php endforeach; ?>
                                        </div>
                                        <!--Artist Mobile View End-->
                                        <div class="">
                                            <?php
                                            //echo "SELECT * FROM tbl_advertisement WHERE status = 1 AND cid='".$_GET['workid']."'";
                                            $aqry = mysql_query("SELECT * FROM tbl_advertisement WHERE status = 1 AND cid='" . $_GET['workid'] . "'");
                                            $arow = mysql_fetch_array($aqry);
                                            //print_r($arow); die;
                                            $addimage = $_SESSION['FRNT_DOMAIN_NAME'] . 'upload/advertisement/' . $arow['image'];
                                            ?>
                                            <a href="#" class="ad-images">
                                                <div class="col-xs-12 clearfix artistlist-profile" style="background-image: url('<?php echo $addimage; ?>');">&nbsp;</div>
                                                <!--<h3><?php echo $arow['title']; ?></h3>-->
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-xs-12 wi70">
                                        <!-- Projects Row -->
                                        <div class="home-cont-row">
                                            <?php
                                            //print_r($_REQUEST); die;
                                            "SELECT aid FROM tbl_suggested_artist where cid=" . $_REQUEST['workid'];
                                            $qrya = mysql_query("SELECT aid FROM tbl_suggested_artist where cid=" . $_REQUEST['workid']);
                                            $arraysel = array();
                                            while ($dataq = mysql_fetch_array($qrya)) {
                                                $arraysel[] = $dataq['aid'];
                                            }
//print_r($arraysel); die;
                                            
                                            foreach ($controller_class->artistlistbycategory as $key => $catdata):
                                                if (!in_array($catdata['id'], $arraysel)) {
                                                    continue;
                                                }
                                                if (is_file($_SESSION['SITE_IMG_PATH'] . "artist/" . $catdata['image'])) {
                                                    $userimage = $_SESSION['FRNT_DOMAIN_NAME'] . "upload/artist/" . $catdata['image'];
                                                } else {
                                                    $userimage = $_SESSION['FRNT_DOMAIN_NAME'] . "img/no-profile-picture-icon-620x389.jpg";
                                                }
                                                $plan = $controller_class->userDetails($catdata['id']);
                                               
                                                if($plan['plan_id'] > 1){
                                                    ?>
                                                    <!--Select Artist Start-->
                                                <div class="desktopview-art">
                                                    <div class="artistlist-rightbox serch-box">
                                                        <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'] . "artistpreview/" . $catdata['username'] . "/" . $_GET['workid']; ?>">
                                                            <div class="col-xs-12"  style="background-image: url('<?php echo $userimage; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;">&nbsp;</div>
                                                            <h3><?php echo $catdata['first_name'] . " " . $catdata['last_name']; ?></h3>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!--Select Artist End-->    
                                                        
                                                    <?php
                                                }
                                                ?>
                                                
                                            <?php endforeach; ?>
                                            <?php
                                            foreach ($controller_class->artistlistbycategory as $key => $catdata):
                                                if (in_array($catdata['id'], $arraysel)) {
                                                    continue;
                                                }
                                                if (is_file($_SESSION['SITE_IMG_PATH'] . "artist/" . $catdata['image'])) {
                                                    $userimage = $_SESSION['FRNT_DOMAIN_NAME'] . "upload/artist/" . $catdata['image'];
                                                } else {
                                                    $userimage = $_SESSION['FRNT_DOMAIN_NAME'] . "img/no-profile-picture-icon-620x389.jpg";
                                                }
                                                $plan = $controller_class->userDetails($catdata['id']);
                                               
                                                if($plan['plan_id'] > 1){
                                                ?>
                                                <div class="artistlist-rightbox serch-box">
                                                    <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'] . "artistpreview/" . $catdata['username'] . "/" . $_GET['workid']; ?>">
                                                        <div class="col-xs-12"  style="background-image: url('<?php echo $userimage; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;">&nbsp;</div>
                                                        <h3> <?php echo $catdata['first_name'] . " " . $catdata['last_name']; ?> </h3>
                                                    </a>
                                                </div>
                                                
                                                <?php
                                                 
                                                }
                                                ?>
                                                
                                                <!--<?php
                                                $modcnt++;
                                                if ($modcnt % 4 == 0):
                                                    ?></div>
                                                                                                    <div class="row home-cont-row"><?php endif; ?>-->
                                            <?php endforeach; ?>
                                            <?php if (empty($controller_class->artistlistbycategory)): ?>
                                                <div class="callout callout-info">
                                                    <h4>No Artist Found</h4>
                                                    <p><i class="fa fa-info-circle"></i> There is no artist under this category.</p>            
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <!--<hr>-->
                                <!-- Pagination -->
                                <!--<div class="row text-center">
                                    <div class="col-lg-12">
                                        <ul class="pagination">
                                            <li>
                                                <a href="#">�</a>
                                            </li>
                                            <li class="active">
                                                <a href="#">1</a>
                                            </li>
                                            <li>
                                                <a href="#">2</a>
                                            </li>
                                            <li>
                                                <a href="#">3</a>
                                            </li>
                                            <li>
                                                <a href="#">4</a>
                                            </li>
                                            <li>
                                                <a href="#">5</a>
                                            </li>
                                            <li>
                                                <a href="#">�</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>--><!-- /.Pagination -->
                                <!--<hr>-->
                            </div>
                        </div>
                    </section><!-- /.content -->
                </aside><!-- /.right-side -->
            </div><!-- ./wrapper -->
            <?php include('footernew.php'); ?>
        </div>
    </div>
    <style>
        .itemartistsugg{background: #c7edfc none repeat scroll 0 0 !important;}
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#src_country').change(function () {
                //Code
                $("#src_state").html("<option value=''>Select State</option>");
                $.ajax({
                    method: "POST",
                    url: site_url + "controllers/ajax_controller/register-ajax-controller.php",
                    data: {getStateListByCountry: "getStateListByCountryChk", cnt_id: this.value}
                })
                        .done(function (data) {
                            $("#src_state").html(data);
                        });
            });
            $("#btn_search_show").click(function () {
                $(".box-body").toggle();
                $("#btn_search_artist").toggle();
                $("#btn_search_show").toggle();
                $("#btn_search_hide").toggle();
            })
            $("#btn_search_hide").click(function () {
                $(".box-body").toggle();
                $("#btn_search_artist").toggle();
                $("#btn_search_show").toggle();
                $("#btn_search_hide").toggle();
            })
            $(".box-body").hide();
            $("#btn_search_artist").hide();
            $("#btn_search_hide").hide();
        });
    </script>
</body>