<body class="skin-blue">
    <div class="container">
        <div class="row blue-border-main">
            <!-- header logo: style can be found in header.less -->
            <?php require_once($_SESSION['APP_PATH'] . "views/artistimage-header.php"); ?>
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
                            <div class="mainbox-boder">
                                <!-- Content Header (Page header) -->
                                <section class="content-header">
                                    <ol class="breadcrumb">
                                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                                    </ol>
                                </section>
                                <!-- Page Header -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h1 class="page-header">Images <small>Secondary Text</small>
                                        </h1>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <!-- Projects Row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="event-com">
                                            <div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "columnWidth": 0 }'>
                                                <?php
                                                $modcnt = 0;
                                                foreach ($controller_class->getuserimages as $key => $imgsdata):
                                                    if ($imgsdata['category_id'] != '13') {
                                                        $imgcurrency = $controller_class->getcurrencydetailbyid($imgsdata['price_currency']);
                                                        ?>
                                                        <div class="grid-item">
                                                            <figure class="effect-ming gallery-img-das">
                                                                <figcaption>
                                                                    <div class="portfolio-box">
                                                                        <div class="portfolio-item 111">
                                                                            <?php if ($_SESSION['po_userses']['flc_usrlogin_plan'] == 3): ?>
                                                                                <a class="fancybox" href="#inline-pop-img-<?php echo $imgsdata['id']; ?>">
                                                                                    <img src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/300/" . $imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                                                                                </a>
                                                                             <!-- <a id="Zoom-1" class="MagicZoom" href="<?php echo $_SESSION['SITE_NAME'] . "upload/images/" . $imgsdata['image']; ?>">
                                                                                <img src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/300/" . $imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                                                                            </a>-->
                                                                            <?php else: ?>
                                                                                <a class="fancybox" href="#inline-pop-img-<?php echo $imgsdata['id']; ?>">
                                                                                    <img src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/" . $imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                                                                                </a>
                                                                                 <!--  <a id="Zoom-1" class="MagicZoom" href="<?php echo $_SESSION['SITE_NAME'] . "upload/images/" . $imgsdata['image']; ?>">
                                                                                    <img src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/" . $imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                                                                                </a>-->
                                                                            <?php endif; ?>
                                                                            <a class="img-edit" href="<?php echo $_SESSION['SITE_NAME']; ?>editimage/<?php echo $imgsdata['id']; ?>"><i class="fa fa-pencil-square-o edit-icon" title="Edit image"></i></a>
                                                                            <button class="btn_delete_img" id="btn_delete_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>"><i class="fa fa-trash-o">&nbsp;</i></button>
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                    <div class="col-sm-7 text-left comm-padding" id="div_radioajax<?= $key ?>"> 
                                                                                        <?php
                                                                                        $checkyes = '';
                                                                                        $checkno = '';
                                                                                        if ($imgsdata['show_front'] == 1) {
                                                                                            $checkyes = 'checked="checked"';
                                                                                        } elseif ($imgsdata['show_front'] == 0) {
                                                                                            $checkno = 'checked="checked"';
                                                                                        }
                                                                                        ?>
                                                                                        <div class="radio-inline" id="id_yes<?= $key ?>">
                                                                                            <label>
                                                                                                <input type="radio" name="show_frontend<?= $key ?>" id="chk_showonfront<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="1"
                                                                                                <?= $checkyes ?>
                                                                                                       />
                                                                                                <span>Yes</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="radio-inline" id="id_no<?= $key ?>">
                                                                                            <label>
                                                                                                <input type="radio" name="show_frontend<?= $key ?>" id="chk_hideonfront<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="0"
                                                                                                       <?= $checkno ?>  />
                                                                                                <span>No</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <script>
                                                                                            $(document).ready(function () {
                                                                                                $('input[name="show_frontend<?= $key ?>"]').on('click', function (event) {
                                                                                                    var userimg = jQuery(this).data("userimg");
                                                                                                    var seleval = this.value;
                                                                                                    jQuery.ajax({
                                                                                                        method: "POST",
                                                                                                        url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                                                                                                        data: {changeshowstatus: "changeshowstatusChk", values: this.value, userimg: userimg, key: <?= $key ?>}
                                                                                                    })
                                                                                                            .done(function (data) {
                                                                                                                $("#div_radioajax" +<?= $key ?>).html(data);
                                                                                                                //location.reload();
                                                                                                            });
                                                                                                });
                                                                                            });
                                                                                        </script>
                                                                                    </div>
                                                                                    <div class="col-xs-5 pull-right">
                                                                                        <?php if ($imgsdata['is_sold'] == 1): ?>
                                                                                            <button class="pull-right margin-top-10 btn btn-danger btn_sold_img" id="btn_soldsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">SOLD</button> &nbsp;
                                                                                        <?php else: ?>
                                                                                            <button class="pull-right margin-top-10 btn btn-success btn_unsold_img" id="btn_soldsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">For Sale</button> &nbsp;
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- //////bid ///start///////// -->
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                    <div class="col-sm-7 text-left comm-padding" id="div_radioajaxbid<?= $key ?>"> 
                                                                                        <?php
                                                                                        $checkyes = '';
                                                                                        $checkno = '';
                                                                                        if ($imgsdata['is_bid'] == 1) {
                                                                                            $checkyes = 'checked="checked"';
                                                                                        } elseif ($imgsdata['is_bid'] == 0) {
                                                                                            $checkno = 'checked="checked"';
                                                                                        }
                                                                                        ?>
                                                                                        <div class="radio-inline" id="id_yes<?= $key ?>">
                                                                                            <label>
                                                                                                <input type="radio" name="show_isbid<?= $key ?>" id="chk_showisbid<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="1"
                                                                                                <?= $checkyes ?>
                                                                                                       />
                                                                                                <span>Yes</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="radio-inline" id="id_no<?= $key ?>">
                                                                                            <label>
                                                                                                <input type="radio" name="show_isbid<?= $key ?>" id="chk_hideisbid<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="0"
                                                                                                       <?= $checkno ?>  />
                                                                                                <span>No</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <script>
                                                                                            $(document).ready(function () {
                                                                                                $('input[name="show_isbid<?= $key ?>"]').on('click', function (event) {
                                                                                                    var userimg = jQuery(this).data("userimg");
                                                                                                    var seleval = this.value;
                                                                                                    jQuery.ajax({
                                                                                                        method: "POST",
                                                                                                        url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                                                                                                        data: {changeshowstatusbid: "changeshowstatusChkbid", values: this.value, userimg: userimg, key: <?= $key ?>}
                                                                                                    })
                                                                                                            .done(function (data) {
                                                                                                                $("#div_radioajaxbid" +<?= $key ?>).html(data);
                                                                                                                //location.reload();
                                                                                                            });
                                                                                                });
                                                                                            });
                                                                                        </script>
                                                                                    </div>
                                                                                    <div class="col-xs-5 pull-right">
                                                                                        <?php if ($imgsdata['is_sold'] == 1): ?>
                                                                                            <button class="pull-right margin-top-10 btn btn-danger btn_showbid_img" id="btn_showbidsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">Bid</button> &nbsp;
                                                                                        <?php else: ?>
                                                                                            <button class="pull-right margin-top-10 btn btn-success btn_hidebid_img" id="btn_hidebidsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">Bid</button> &nbsp;
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- //////////Bid/////end///////////// -->
                                                                            <!-- ////Rent///start///////// -->
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                    <div class="col-sm-7 text-left comm-padding" id="div_radioajaxrent<?= $key ?>"> 
                                                                                        <?php
                                                                                        $checkyes = '';
                                                                                        $checkno = '';
                                                                                        if ($imgsdata['is_rent'] == 1) {
                                                                                            $checkyes = 'checked="checked"';
                                                                                        } elseif ($imgsdata['is_rent'] == 0) {
                                                                                            $checkno = 'checked="checked"';
                                                                                        }
                                                                                        ?>
                                                                                        <div class="radio-inline" id="id_yes<?= $key ?>">
                                                                                            <label>
                                                                                                <input type="radio" name="show_isrent<?= $key ?>" id="chk_showisrent<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="1"
                                                                                                <?= $checkyes ?>
                                                                                                       />
                                                                                                <span>Yes</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="radio-inline" id="id_no<?= $key ?>">
                                                                                            <label>
                                                                                                <input type="radio" name="show_isrent<?= $key ?>" id="chk_hideisrent<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="0"
                                                                                                       <?= $checkno ?>  />
                                                                                                <span>No</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <script>
                                                                                            $(document).ready(function () {
                                                                                                $('input[name="show_isrent<?= $key ?>"]').on('click', function (event) {
                                                                                                    var userimg = jQuery(this).data("userimg");
                                                                                                    var seleval = this.value;
                                                                                                    jQuery.ajax({
                                                                                                        method: "POST",
                                                                                                        url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                                                                                                        data: {changeshowstatusrent: "changeshowstatusChkrent", values: this.value, userimg: userimg, key: <?= $key ?>}
                                                                                                    })
                                                                                                            .done(function (data) {
                                                                                                                $("#div_radioajaxrent" +<?= $key ?>).html(data);
                                                                                                                //location.reload();
                                                                                                            });
                                                                                                });
                                                                                            });
                                                                                        </script>
                                                                                    </div>
                                                                                    <div class="col-xs-5 pull-right">
                                                                                        <?php if ($imgsdata['is_rent'] == 1): ?>
                                                                                            <button class="pull-right margin-top-10 btn btn-danger btn_showrent_img" id="btn_showrentsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">Rent</button> &nbsp;
                                                                                        <?php else: ?>
                                                                                            <button class="pull-right margin-top-10 btn btn-success btn_hiderent_img" id="btn_hiderentsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">Rent</button> &nbsp;
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- //////////Rent/////end///////////// -->
                                                                            <div class="row">
                                                                                <div class="col-xs-12 text-left">
                                                                                    <div id="div_radioajaxp<?= $key ?>">
                                                                                        <a class="price_btn" href="<?php echo $_SESSION['SITE_NAME']; ?>editimage/<?php echo $imgsdata['id']; ?>">
                                                                                            <button class="margin-top-10 btn btn-warning btn_price_img" ><?php echo $imgcurrency['cur_text']; ?><?php echo $imgsdata['img_price']; ?></button> &nbsp;</a>
                                                                                        <div class="radio-main price_radio_btn">
                                                                                            <?php
                                                                                            $checkyesp = '';
                                                                                            $checknop = '';
                                                                                            if ($imgsdata['showprice_front'] == 1) {
                                                                                                $checkyesp = 'checked="checked"';
                                                                                            } elseif ($imgsdata['showprice_front'] == 0) {
                                                                                                $checknop = 'checked="checked"';
                                                                                            }
                                                                                            ?>
                                                                                            <div class="radio-inline" id="id_yesp<?= $key ?>">
                                                                                                <label>
                                                                                                    <input type="radio" name="show_frontendp<?= $key ?>" id="chk_showonfrontp<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="1"
                                                                                                    <?= $checkyesp ?>
                                                                                                           />
                                                                                                    <span>Yes</span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="radio-inline" id="id_nop<?= $key ?>">
                                                                                                <label>
                                                                                                    <input type="radio" name="show_frontendp<?= $key ?>" id="chk_hideonfrontp<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="0"
                                                                                                           <?= $checknop ?>  />
                                                                                                    <span>No</span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <script>
                                                                                                $(document).ready(function () {
                                                                                                    $('input[name="show_frontendp<?= $key ?>"]').on('click', function (event) {
                                                                                                        var userimg = jQuery(this).data("userimg");
                                                                                                        var seleval = this.value;
                                                                                                        jQuery.ajax({
                                                                                                            method: "POST",
                                                                                                            url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                                                                                                            data: {changeshowstatusp: "changeshowstatusChk", values: this.value, userimg: userimg, key: <?= $key ?>}
                                                                                                        })
                                                                                                                .done(function (data) {
                                                                                                                    $("#div_radioajaxp" +<?= $key ?>).html(data);
                                                                                                                    //location.reload();
                                                                                                                });
                                                                                                    });
                                                                                                });
                                                                                            </script>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="buttons-wrapper">
                                                                                <div class="row">
                                                                                    <?php /* <div class="col-sm-12">
                                                                                      <button class="btn btn-warning pull-right">Auction</button>
                                                                                      <div class="radio-main price_radio_btn">
                                                                                      <div class="radio-inline">
                                                                                      <label>
                                                                                      <input type="radio" name="auction1" id="auction1"  value="1" checked="checked">
                                                                                      <span>Yes</span>
                                                                                      </label>
                                                                                      </div>
                                                                                      <div class="radio-inline">
                                                                                      <label>
                                                                                      <input type="radio" name="auction1" id="auction2" value="0">
                                                                                      <span>No</span>
                                                                                      </label>
                                                                                      </div>
                                                                                      </div>
                                                                                      </div>
                                                                                      <div class="col-sm-12">
                                                                                      <button class="btn btn-success pull-right">Rent</button>
                                                                                      <div class="radio-main price_radio_btn">
                                                                                      <div class="radio-inline">
                                                                                      <label>
                                                                                      <input type="radio" name="rent1" id="rent1"  value="1" checked="checked">
                                                                                      <span>Yes</span>
                                                                                      </label>
                                                                                      </div>
                                                                                      <div class="radio-inline">
                                                                                      <label>
                                                                                      <input type="radio" name="rent1" id="rent2" value="0">
                                                                                      <span>No</span>
                                                                                      </label>
                                                                                      </div>
                                                                                      </div>
                                                                                      </div> */ ?>
                                                                                </div>
                                                                            </div>
                                                                            <h3 class="img-title">
                                                                                <?php echo $imgsdata['img_title']; ?>
                                                                            </h3>
                                                                            <p class="img-desbox"><?php echo $imgsdata['image_text']; ?></p>
                                                                            <input type="hidden" value="<?php echo $imgsdata['is_sold']; ?>" name="hid_is_sold_<?php echo $imgsdata['id']; ?>" id="hid_is_sold_<?php echo $imgsdata['id']; ?>">
                                                                            <div id="inline-pop-img-<?php echo $imgsdata['id']; ?>" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
                                                                                <div class="row">
                                                                                    <div class="col-lg-8 col-md-8 col-xs-12">
                                                                                        <?php if ($_SESSION['po_userses']['flc_usrlogin_plan'] == 3): ?>
                                                                                            <div class=' col-xs-12 zoom img-to-zoom' id='img-to-zoom-<?php echo $imgsdata['id']; ?>'>
                                                                                                <a id="Zoom-1" class="MagicZoom" href="<?php echo $_SESSION['SITE_NAME'] . "upload/images/" . $imgsdata['image']; ?>">
                                                                                                    <img class="example-image img-responsive" id="inline-pop-img-<?php echo $imgsdata['id']; ?>-img" alt="..." src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/" . $imgsdata['image']; ?>">
                                                                                                </a>
                                            <!--<p>Click to zoom</p>--></div>
                                                                                        <?php else: ?>
                                                                                            <img class="example-image img-responsive" id="inline-pop-img-<?php echo $imgsdata['id']; ?>-img" alt="..." src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/" . $imgsdata['image']; ?>">
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-md-4 col-xs-12 portfolio-item">
                                                                                        <h3 class="img-title">
                                                                                            <?php echo $imgsdata['img_title']; ?>
                                                                                        </h3>
                                                                                        <p class="img-desbox"><?php echo $imgsdata['image_text']; ?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </figcaption>
                                                            </figure>
                                                        </div>
                                                        <?php
                                                        $modcnt++;
                                                        if ($modcnt % 4 == 0):
                                                            ?>
                                                        <?php endif; ?>
                                                        <?php
                                                    }
                                                endforeach;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h1 class="page-headermusic">Music
                                            <small>Secondary Text</small>
                                        </h1>
                                    </div>
                                </div>
                                <div class="event-com">
                                    <div class="grid js-masonry container" data-masonry-options='{ "itemSelector": ".grid-item", "columnWidth": 0 }' style="padding:0;">
                                        <?php
                                        $modcnt = 0;
                                        foreach ($controller_class->getuserimages as $key => $imgsdata):
                                            if ($imgsdata['music'] != '') {
                                                $imgcurrency = $controller_class->getcurrencydetailbyid($imgsdata['price_currency']);
                                                ?>
                                                <div class="grid-item">
                                                    <figure class="effect-ming gallery-img-das">
                                                        <figcaption>
                                                            <div class="portfolio-box">
                                                                <div class="portfolio-item">
                                                                    <?php if ($_SESSION['po_userses']['flc_usrlogin_plan'] == 3): ?>
                                                                        <a class="fancybox" href="#inline-pop-img-<?php echo $imgsdata['id']; ?>">
                                                                            <img src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/300/" . $imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <a class="fancybox" href="#inline-pop-img-<?php echo $imgsdata['id']; ?>">
                                                                            <img src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/" . $imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                                                                        </a>
                                                                    <?php endif; ?>
                                                                    <a class="img-edit" href="<?php echo $_SESSION['SITE_NAME']; ?>editimage/<?php echo $imgsdata['id']; ?>"><i class="fa fa-pencil-square-o edit-icon" title="Edit image"></i></a>
                                                                    <button class="btn_delete_img" id="btn_delete_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>"><i style="margin-left:4px" class="fa fa-trash-o">&nbsp;</i></button>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                                            <div class="col-sm-7 text-left comm-padding" id="div_radioajax<?= $key ?>"> 
                                                                                <div class="radio-main">
                                                                                    <div class="radio-inline" >
                                                                                        <label>
                                                                                            <?php
                                                                                            $checkyes = '';
                                                                                            $checkno = '';
                                                                                            if ($imgsdata['show_front'] == 1) {
                                                                                                $checkyes = 'checked="checked"';
                                                                                            } elseif ($imgsdata['show_front'] == 0) {
                                                                                                $checkno = 'checked="checked"';
                                                                                            }
                                                                                            ?>
                                                                                            <input type="radio" name="show_frontend<?= $key ?>" id="chk_showonfront<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="1"
                                                                                            <?= $checkyes ?>
                                                                                                   />
                                                                                            <span>Yes</span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="radio-inline">
                                                                                        <label>
                                                                                            <input type="radio" name="show_frontend<?= $key ?>" id="chk_hideonfront<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="0"
                                                                                                   <?= $checkno ?>  />
                                                                                            <span>No</span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <script>
                                                                                        $(document).ready(function () {
                                                                                            $('input[name="show_frontend<?= $key ?>"]').on('click', function (event) {
                                                                                                var userimg = jQuery(this).data("userimg");
                                                                                                var seleval = this.value;
                                                                                                jQuery.ajax({
                                                                                                    method: "POST",
                                                                                                    url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                                                                                                    data: {changeshowstatus: "changeshowstatusChk", values: this.value, userimg: userimg, key: <?= $key ?>}
                                                                                                })
                                                                                                        .done(function (data) {
                                                                                                            $("#div_radioajax" +<?= $key ?>).html(data);
                                                                                                            //location.reload();
                                                                                                        });
                                                                                            });
                                                                                        });
                                                                                    </script>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xs-5 pull-right">
                                                                                <?php if ($imgsdata['is_sold'] == 1): ?>
                                                                                    <button class="pull-right margin-top-10 btn btn-danger btn_sold_img" id="btn_soldsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">SOLD</button> &nbsp;
                                                                                <?php else: ?>
                                                                                    <button class="pull-right margin-top-10 btn btn-success btn_unsold_img" id="btn_soldsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">For Sale</button> &nbsp;
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <a class="price_btn" href="<?php echo $_SESSION['SITE_NAME']; ?>editimage/<?php echo $imgsdata['id']; ?>">
                                                                                <div class="margin-top-10 btn btn-warning btn_price_img" ><?php echo $imgcurrency['cur_text']; ?><?php echo $imgsdata['img_price']; ?></div> &nbsp;</a>
                                                                            <div class="price_radio_btn" id="div_radioajaxp<?= $key ?>">
                                                                                <?php
                                                                                $checkyesp = '';
                                                                                $checknop = '';
                                                                                if ($imgsdata['showprice_front'] == 1) {
                                                                                    $checkyesp = 'checked="checked"';
                                                                                } elseif ($imgsdata['showprice_front'] == 0) {
                                                                                    $checknop = 'checked="checked"';
                                                                                }
                                                                                ?>
                                                                                <div class="radio-main">
                                                                                    <div class="radio-inline" id="id_yesp<?= $key ?>">
                                                                                        <label>
                                                                                            <input type="radio" name="show_frontendp<?= $key ?>" id="chk_showonfrontp<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="1" 	<?= $checkyesp ?> />
                                                                                            <span>Yes</span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="radio-inline" id="id_nop<?= $key ?>">
                                                                                        <label>
                                                                                            <input type="radio" name="show_frontendp<?= $key ?>" id="chk_hideonfrontp<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="0"
                                                                                                   <?= $checknop ?>  />
                                                                                            <span>No</span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <script>
                                                                                    $(document).ready(function () {
                                                                                        $('input[name="show_frontendp<?= $key ?>"]').on('click', function (event) {
                                                                                            var userimg = jQuery(this).data("userimg");
                                                                                            var seleval = this.value;
                                                                                            jQuery.ajax({
                                                                                                method: "POST",
                                                                                                url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                                                                                                data: {changeshowstatusp: "changeshowstatusChk", values: this.value, userimg: userimg, key: <?= $key ?>}
                                                                                            })
                                                                                                    .done(function (data) {
                                                                                                        $("#div_radioajaxp" +<?= $key ?>).html(data);
                                                                                                        //location.reload();
                                                                                                    });
                                                                                        });
                                                                                    });
                                                                                </script>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="buttons-wrapper">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <div class="col-sm-7 text-left comm-padding" id="div_radioajaxbid<?= $key ?>"> 
                                                                                    <?php
                                                                                    $checkyes = '';
                                                                                    $checkno = '';
                                                                                    if ($imgsdata['is_bid'] == 1) {
                                                                                        $checkyes = 'checked="checked"';
                                                                                    } elseif ($imgsdata['is_bid'] == 0) {
                                                                                        $checkno = 'checked="checked"';
                                                                                    }
                                                                                    ?>
                                                                                    <div class="radio-inline" id="id_yes<?= $key ?>">
                                                                                        <label>
                                                                                            <input type="radio" name="show_isbid<?= $key ?>" id="chk_showisbid<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="1"
                                                                                            <?= $checkyes ?>
                                                                                                   />
                                                                                            <span>Yes</span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="radio-inline" id="id_no<?= $key ?>">
                                                                                        <label>
                                                                                            <input type="radio" name="show_isbid<?= $key ?>" id="chk_hideisbid<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="0"
                                                                                                   <?= $checkno ?>  />
                                                                                            <span>No</span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <script>
                                                                                        $(document).ready(function () {
                                                                                            $('input[name="show_isbid<?= $key ?>"]').on('click', function (event) {
                                                                                                var userimg = jQuery(this).data("userimg");
                                                                                                var seleval = this.value;
                                                                                                jQuery.ajax({
                                                                                                    method: "POST",
                                                                                                    url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                                                                                                    data: {changeshowstatusbid: "changeshowstatusChkbid", values: this.value, userimg: userimg, key: <?= $key ?>}
                                                                                                })
                                                                                                        .done(function (data) {
                                                                                                            $("#div_radioajaxbid" +<?= $key ?>).html(data);
                                                                                                            //location.reload();
                                                                                                        });
                                                                                            });
                                                                                        });
                                                                                    </script>
                                                                                </div>
                                                                                <div class="col-xs-5 pull-right">
                                                                                    <?php if ($imgsdata['is_sold'] == 1): ?>
                                                                                        <button class="pull-right margin-top-10 btn btn-danger btn_showbid_img" id="btn_showbidsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">Bid</button> &nbsp;
                                                                                    <?php else: ?>
                                                                                        <button class="pull-right margin-top-10 btn btn-success btn_hidebid_img" id="btn_hidebidsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">Bid</button> &nbsp;
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- //////////Bid/////end///////////// -->
                                                                        <!-- ////Rent///start///////// -->
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <div class="col-sm-7 text-left comm-padding" id="div_radioajaxrent<?= $key ?>"> 
                                                                                    <?php
                                                                                    $checkyes = '';
                                                                                    $checkno = '';
                                                                                    if ($imgsdata['is_rent'] == 1) {
                                                                                        $checkyes = 'checked="checked"';
                                                                                    } elseif ($imgsdata['is_rent'] == 0) {
                                                                                        $checkno = 'checked="checked"';
                                                                                    }
                                                                                    ?>
                                                                                    <div class="radio-inline" id="id_yes<?= $key ?>">
                                                                                        <label>
                                                                                            <input type="radio" name="show_isrent<?= $key ?>" id="chk_showisrent<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="1"
                                                                                            <?= $checkyes ?>
                                                                                                   />
                                                                                            <span>Yes</span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="radio-inline" id="id_no<?= $key ?>">
                                                                                        <label>
                                                                                            <input type="radio" name="show_isrent<?= $key ?>" id="chk_hideisrent<?= $key ?>" data-userimg="<?php echo $imgsdata['id']; ?>" value="0"
                                                                                                   <?= $checkno ?>  />
                                                                                            <span>No</span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <script>
                                                                                        $(document).ready(function () {
                                                                                            $('input[name="show_isrent<?= $key ?>"]').on('click', function (event) {
                                                                                                var userimg = jQuery(this).data("userimg");
                                                                                                var seleval = this.value;
                                                                                                jQuery.ajax({
                                                                                                    method: "POST",
                                                                                                    url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                                                                                                    data: {changeshowstatusrent: "changeshowstatusChkrent", values: this.value, userimg: userimg, key: <?= $key ?>}
                                                                                                })
                                                                                                        .done(function (data) {
                                                                                                            $("#div_radioajaxrent" +<?= $key ?>).html(data);
                                                                                                            //location.reload();
                                                                                                        });
                                                                                            });
                                                                                        });
                                                                                    </script>
                                                                                </div>
                                                                                <div class="col-xs-5 pull-right">
                                                                                    <?php if ($imgsdata['is_rent'] == 1): ?>
                                                                                        <button class="pull-right margin-top-10 btn btn-danger btn_showrent_img" id="btn_showrentsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">Rent</button> &nbsp;
                                                                                    <?php else: ?>
                                                                                        <button class="pull-right margin-top-10 btn btn-success btn_hiderent_img" id="btn_hiderentsts_img_<?php echo $imgsdata['id']; ?>" data-userimg="<?php echo $imgsdata['id']; ?>">Rent</button> &nbsp;
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <h3 class="img-title">
                                                                        <?php echo $imgsdata['img_title']; ?>
                                                                    </h3>
                                                                    <p class="img-desbox"><?php echo $imgsdata['image_text']; ?></p>
                                                                    <input type="hidden" value="<?php echo $imgsdata['is_sold']; ?>" name="hid_is_sold_<?php echo $imgsdata['id']; ?>" id="hid_is_sold_<?php echo $imgsdata['id']; ?>">
                                                                    <div id="inline-pop-img-<?php echo $imgsdata['id']; ?>" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-8 col-md-8 col-xs-12">
                                                                                <?php if ($_SESSION['po_userses']['flc_usrlogin_plan'] == 3): ?>
                                                                                                                                    <div class=' col-xs-12 zoom img-to-zoom' id='img-to-zoom-<?php echo $imgsdata['id']; ?>'><img class="example-image img-responsive" id="inline-pop-img-<?php echo $imgsdata['id']; ?>-img" alt="..." src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/" . $imgsdata['image']; ?>"><!--<p>Click to zoom</p>--></div>
                                                                                <?php else: ?>
                                                                                    <img class="example-image img-responsive" id="inline-pop-img-<?php echo $imgsdata['id']; ?>-img" alt="..." src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/" . $imgsdata['image']; ?>">
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-xs-12 portfolio-item">
                                                                                <h3 class="img-title">
                                                                                    <?php echo $imgsdata['img_title']; ?>
                                                                                </h3>
                                                                                <p class="img-desbox"><?php echo $imgsdata['image_text']; ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </figcaption>
                                                    </figure>
                                                </div>
                                                <?php
                                                $modcnt++;
                                                if ($modcnt % 4 == 0):
                                                    ?>
                                                <?php endif; ?>
                                                <?php
                                            }
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!-- /.content -->
                </aside><!-- /.right-side -->
            </div><!-- ./wrapper -->
            <?php include('footernew.php'); ?>
        </div>
    </div>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            $('.grid').masonry({
                itemSelector: '.grid-item',
                columnWidth: 0,
                isAnimated: true,
                animationOptions: {
                    duration: 500,
                    easing: 'linear',
                    queue: false
                }
            });
            jQuery('.btn_sold_img').each(function () {
                jQuery(this).click(function () {
                    //Code
                    var r = confirm("Are you sure you want to change sold status of this image?");
                    if (r == true) {
                        var userimg = jQuery(this).data("userimg");
                        var soldsts = jQuery("#hid_is_sold_" + userimg).val();
                        changesoldstatus(userimg, soldsts);
                    }
                });
            });
            jQuery('.btn_unsold_img').each(function () {
                jQuery(this).click(function () {
                    //Code
                    var r = confirm("Are you sure you want to change sold status of this image?");
                    if (r == true) {
                        var userimg = jQuery(this).data("userimg");
                        var soldsts = jQuery("#hid_is_sold_" + userimg).val();
                        changesoldstatus(userimg, soldsts);
                    }
                });
            });
            //for bid jquery start
            jQuery('.btn_showbid_img').each(function () {
                jQuery(this).click(function () {
                    //Code
                    var r = confirm("Are you sure you want to change bid status of this image?");
                    if (r == true) {
                        var userimg = jQuery(this).data("userimg");
                        var soldsts = jQuery("#hid_is_sold_" + userimg).val();
                        changebidstatus(userimg, soldsts);
                    }
                });
            });
            jQuery('.btn_hidebid_img').each(function () {
                jQuery(this).click(function () {
                    //Code
                    var r = confirm("Are you sure you want to change bid status of this image?");
                    if (r == true) {
                        var userimg = jQuery(this).data("userimg");
                        var soldsts = jQuery("#hid_is_sold_" + userimg).val();
                        changebidstatus(userimg, soldsts);
                    }
                });
            });
            function changebidstatus(userimg, soldsts) {
                var userimg = userimg;
                //Code
                jQuery.ajax({
                    method: "POST",
                    url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                    data: {changeshowstatusrent: "changeshowstatusChkbid", userimg: userimg, soldsts: soldsts}
                })
                .done(function (data) {
                    data = jQuery.trim(data);
                    jQuery('#hid_is_sold_' + userimg).val(data);
                    if (parseInt(data) == 1) {
                        jQuery('#btn_showbidsts_img_' + userimg).removeClass("btn-success");
                        jQuery('#btn_showbidsts_img_' + userimg).addClass("btn-danger");
                        jQuery('#btn_showbidsts_img_' + userimg).html("Show Bid");
                    } else {
                        jQuery('#btn_showbidsts_img_' + userimg).addClass("btn-success");
                        jQuery('#btn_showbidsts_img_' + userimg).removeClass("btn-danger");
                        jQuery('#btn_showbidsts_img_' + userimg).html("Hide Bid");
                    }
                });
            }
            // for bid jquery end
            //for Rent jquery start  /////////////////rent
            jQuery('.btn_showrent_img').each(function () {
                jQuery(this).click(function () {
                    //Code
                    var r = confirm("Are you sure you want to change rent status of this image?");
                    if (r == true) {
                        var userimg = jQuery(this).data("userimg");
                        var soldsts = jQuery("#hid_is_sold_" + userimg).val();
                        changerentstatus(userimg, soldsts);
                    }
                });
            });
            jQuery('.btn_hiderent_img').each(function () {
                jQuery(this).click(function () {
                    //Code
                    var r = confirm("Are you sure you want to change rent status of this image?");
                    if (r == true) {
                        var userimg = jQuery(this).data("userimg");
                        var soldsts = jQuery("#hid_is_sold_" + userimg).val();
                        changerentstatus(userimg, soldsts);
                    }
                });
            });
            function changerentstatus(userimg, soldsts) {
                var userimg = userimg;
                //Code
                jQuery.ajax({
                    method: "POST",
                    url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                    data: {changeshowstatusrent: "changeshowstatusChkrent", userimg: userimg, soldsts: soldsts}
                })
                .done(function (data) {
                    data = jQuery.trim(data);
                    jQuery('#hid_is_sold_' + userimg).val(data);
                    if (parseInt(data) == 1) {
                        jQuery('#btn_showrentsts_img_' + userimg).removeClass("btn-success");
                        jQuery('#btn_showrentsts_img_' + userimg).addClass("btn-danger");
                        jQuery('#btn_showrentsts_img_' + userimg).html("Rent");
                    } else {
                        jQuery('#btn_showrentsts_img_' + userimg).addClass("btn-success");
                        jQuery('#btn_showrentsts_img_' + userimg).removeClass("btn-danger");
                        jQuery('#btn_showrentsts_img_' + userimg).html("Rent");
                    }
                });
            }
            // for Rent jquery end ///////////////////
            jQuery('.btn_delete_img').each(function () {
                jQuery(this).click(function () {
                    //Code
                    var r = confirm("Are you sure you want to delete this image?");
                    if (r == true) {
                        var userimg = jQuery(this).data("userimg");
                        deleteuserimagebyid(userimg);
                    }
                });
            });
        });
        function changesoldstatus(userimg, soldsts) {
            var userimg = userimg;
            //Code
            jQuery.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                data: {changeuerimgsoldstatus: "changeuerimgsoldstatusChk", userimg: userimg, soldsts: soldsts}
            })
            .done(function (data) {
                data = jQuery.trim(data);
                jQuery('#hid_is_sold_' + userimg).val(data);
                if (parseInt(data) == 1) {
                    jQuery('#btn_soldsts_img_' + userimg).removeClass("btn-success");
                    jQuery('#btn_soldsts_img_' + userimg).addClass("btn-danger");
                    jQuery('#btn_soldsts_img_' + userimg).html("Sold");
                } else {
                    jQuery('#btn_soldsts_img_' + userimg).addClass("btn-success");
                    jQuery('#btn_soldsts_img_' + userimg).removeClass("btn-danger");
                    jQuery('#btn_soldsts_img_' + userimg).html("For sale");
                }
            });
        }
        function deleteuserimagebyid(userimg, soldsts) {
            var userimg = userimg;
            //Code
            jQuery.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/artistsimages-ajax-controller.php",
                data: {deleteuserimagebyid: "deleteuserimagebyidChk", userimg: userimg}
            })
            .done(function (data) {
                //alert(jQuery( '#btn_delete_img_'+userimg ).closest( "div.row" ).html());
                //jQuery( '#btn_delete_img_'+userimg ).closest( "div.portfolio-item" ).remove();
                location.reload();
            });
        }
        function getAddPaging(start, end, type)
        {
            $("body").css("cursor", "wait");
            $("#add_perPage").val();
            $("#thumblink").removeClass("select");
            $("#listlink").removeClass("select");
            $.ajax({
                url: site_url + 'controllers/ajax_controller/artistsimages-ajax-controller.php',
                type: 'post',
                data: 'addPagingCode=1&start=' + start + '&end=' + $("#add_perPage").val() + '&type=' + type,
                success: function (result)
                {
                    $("#add_ajax").html(result);
                    $("html, body").animate({scrollTop: 450}, "slow");
                    if (type == 'list') {
                        $("#listlink").addClass("select");
                    } else {
                        $("#thumblink").addClass("select");
                    }
                    $("body").css("cursor", "default");
                }
            });
        }
        function getSliderData(addid)
        {
            $.ajax({
                url: site_url + 'controllers/ajax_controller/artistsimages-ajax-controller.php',
                type: 'post',
                data: 'getSliderDataChk=1&addid=' + addid,
                success: function (result)
                {
                    $("#bluebox_slider").html(result);
                }
            });
        }
    </script>	
    <script>
        $(window).load(function () {
            $('.grid').masonry({
                itemSelector: '.grid-item',
                columnWidth: 0,
                isAnimated: true,
                animationOptions: {
                    duration: 500,
                    easing: 'linear',
                    queue: false
                }
            });
        });
    </script>		
</body>