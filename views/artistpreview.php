<body class="skin-blue">
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/style.css" rel="stylesheet" type="text/css" />
    <link href='<?= $_SESSION['FRNT_DOMAIN_NAME'] ?>background_drag/timeline.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="<?= $_SESSION['FRNT_DOMAIN_NAME'] ?>crop/dist_files/imgareaselect.css">
    <?php

    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

// If the user is on a mobile device, redirect them
    if (isMobile()) {
        ?>
        <style>
            .sticky {
                position: -webkit-sticky;
                top: 0;
            }
        </style>
        <?php
    } else {
        ?><style>
            .sticky {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
            }
            .fancybox-inner{
                overflow: hidden !important;
            }
        </style><?php
    }
    ?> 
    <div class="container">
        <div class="row blue-border-main">
            <!-- header logo: style can be found in header.less -->
            <?php require_once($_SESSION['APP_PATH'] . "views/header.php"); ?>
            <?php
            $usrdetails = $controller_class->usrdetails;
            $_SESSION['po_artistid'] = $usrdetails['id'];
            ?>
            <div class="wrapper row-offcanvas row-offcanvas-left">
                <?php //require_once($_SESSION['APP_PATH']."views/left_part.php");    ?>
                <!-- Right side column. Contains the navbar and content of the page -->
                <aside class="right-side strech">
                    <!-- Main content -->
                    <section class="content">
                        <div class="container">
                            <div class="mgt55">
                                <!-- Content Header (Page header) -->
                                <section class="content-header">
                                    <ol class="breadcrumb">
                                        <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                        <li class="active">Preview</li>
                                    </ol>
                                </section>
                                <!-- Page Header -->
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 artistpreview-btn_new">
                                        <a href="#">Name of Artist</a>
                                        <!--                                        <a href="#">Sponsor  Artist</a>-->
                                        <div class="spacer6"></div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <h1 class="page-header">Artist Preview Page
                                            <small>This is you preview page.</small>
                                        </h1>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 artistpreview-btn new_artish_btn">
                                        <?php
                                        $isInvited = $controller_class->checkIfAlreadyInvitedToChat($usrdetails['id']);
                                        if (!isset($_SESSION['po_userses']['flc_usrlogin_id']) || $_SESSION['po_userses']['flc_usrlogin_id'] == ''):
                                            ?>
                                            <a href="#inline-pop-select-user" class="btn btn-primary btn-sm pull-right">
                                                <span>Invite to Chat</span>
                                            </a>
                                        <?php elseif ($isInvited): ?>
                                            <a class="btn btn-primary btn-sm pull-right" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>chat">Chat</a>
                                        <?php elseif ($usrdetails['id'] != $_SESSION['po_userses']['flc_usrlogin_id']): ?>
                                            <button class="btn btn-primary btn-sm pull-right chat-invite">Chat With Artist</button>
                                        <?php endif; ?>
                                        <?php
                                        if ($usrdetails['paypal_email_show'] == '1') {
                                            ?>
                                            <span class="pull-right">&nbsp;</span>
                                            <button class="btn btn-primary btn-sm pull-right payment-artist">Sponsor Artist</button>
                                        <?php } ?>
                                        <span class="pull-right">&nbsp;</span>
                                        <button class="btn btn-primary btn-sm pull-right follow-artist">Follow  Artist</button>
                                        <span class="pull-right">&nbsp;</span>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <div class="row cf">
                                    <div class="col-lg-9 col-md-9 col-xs-12">
                                        <div class="col-lg-12 no_pd_both">
                                            <ul class="nav nav-tabs artistpreview-tab">
                                                <?php
                                                $previewcategorylist = $controller_class->getcategorylistbyids($controller_class->getpreviewcategories['preview_category']);
                                                $previewcategories = array();
                                                foreach ($previewcategorylist as $k => $catlist) {
                                                    $previewcategories[] = $catlist['id'];
                                                }
                                                if (!empty($previewcategories) && $previewcategories[0] != ''):
                                                    foreach ($previewcategories as $key => $prvcat):
                                                        $catdetail = $controller_class->getartistcategorydetailbyid($prvcat);
                                                        ?>
                                                        <li <?php echo $key == 0 ? " class='active'" : ""; ?>><a data-toggle="tab" href="#prvtab<?php echo $catdetail['id']; ?>" class="radiohostplay" id="<?php echo $catdetail['id']; ?>"><?php echo $catdetail['categoryName']; ?></a></li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        <div class="row preview-container tab-content" id="sortable">
                                            <?php
                                            if (!empty($previewcategories) && $previewcategories[0] != ''):
                                                foreach ($previewcategories as $key => $prvcat):
                                                    $catdetail = $controller_class->getartistcategorydetailbyid($prvcat);
                                                    ?>
                                                    <div id="prvtab<?php echo $catdetail['id']; ?>" class="tab-pane test fade <?php echo $key == 0 ? " in active" : ""; ?>">
                                                        <?php
                                                        $artistpagedata = $controller_class->getartistpreivepagedata($usrdetails['id'], $catdetail['id']);
                                                        $profile_background = "my.jpg";
                                                        if (isset($artistpagedata['profile_background']) && !empty($artistpagedata['profile_background'])) {
                                                            $profile_background = $artistpagedata['profile_background'];
                                                        }
                                                        $imageU = $controller_class->getuserdetailfromuserid($usrdetails['id']);
                                                        if (empty($imageU['image'])) {
                                                            $profile_pic = $_SESSION['SITE_NAME'] . "upload/art/default.jpg";
                                                        } else {
                                                            $profile_pic = $_SESSION['FRNT_DOMAIN_NAME'] . "upload/artist/" . $imageU['image'];
                                                        }
                                                        if (isset($artistpagedata['profile_pic']) && !empty($artistpagedata['profile_pic'])) {
                                                            $profile_pic = $_SESSION['FRNT_DOMAIN_NAME'] . "upload/art/" . $artistpagedata['profile_pic'];
                                                        }
                                                        $profile_background_position = $artistpagedata['profile_background_position'];
                                                        ?>
                                                        <!-- Projects Row -->
                                                        <div class="clearfix" style="margin-top:20px"></div>
                                                        <div class='column col-md-12 no_pd_both'>
                                                            <div id="timelineContainer" style="margin-top:10px">
                                                                <!-- timeline background -->
                                                                <div id="timelineBackground">
                                                                    <img src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'] . "upload/art/" . $profile_background; ?>" class="bgImage" style="margin-top: <?php echo $profile_background_position; ?>;">
                                                                </div>
                                                                <!-- timeline background -->
                                                                <div style="background:url(<?= $_SESSION['FRNT_DOMAIN_NAME'] ?>background_drag/images/timeline_shade.png);" id="timelineShade">
                                                                </div>
                                                                <!-- timeline profile picture -->
                                                                <div id="timelineProfilePic">
                                                                    <img class="custom-file-input" id="profile_picture"  src="<?php echo $profile_pic; ?>" style="width:100%; height:100%;" >
                                                                </div>
                                                                <!-- timeline title -->
                                                                <div id="timelineTitle"><?php echo $name; ?></div>
                                                                <!-- timeline nav -->
                                                                <div id="timelineNav"></div>
                                                            </div>
                                                        </div>
                                                        <?php if ($catdetail['id'] == '16') {
                                                            ?>
                                                            <link rel="stylesheet" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>themes/maccaco/projekktor.style.css" type="text/css" media="screen" />
                                                            <script type="text/javascript" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/projekktor-1.3.09.min.js"></script>
                                                            <style>
                                                                .ppscrubber{display:none;} 
                                                            </style>
                                                            <div id="player_a" class="projekktor"></div>
                                                            <?php
//$qry = mysql_query("SELECT DISTINCT ui.music as music FROM tbl_sales as s left join tbl_user_images as ui on s.pid=ui.id where s.uid = '" . $usrdetails['id'] . "'");
                                                            /* while ($row = mysql_fetch_assoc($qry)) { */
                                                            $musics = mysql_query("SELECT timeline FROM  tbl_radio_host where `user_id` =" . $usrdetails['id']);
                                                            while ($msc = mysql_fetch_array($musics)) {
                                                                $timeline = $msc['timeline'];
                                                                $timelineArg = explode(",", $timeline);
                                                            }
//if(!empty($timelineArg)){
//foreach($timelineArg as $music){
                                                            if (!empty($timelineArg)) {
                                                                ?>
                                                                <ul id="playlist">
                                                                    <?php foreach ($timelineArg as $music) { ?>
                                                                        <li class="active">
                                                                            <a href="<?php echo $FRNT_DOMAIN_NAME; ?>upload/music/<?php echo $music; ?>" data-name="<?php echo $music; ?>">
                                                                                <?php echo $music; ?>
                                                                            </a>
                                                                        </li>
                                                                    <?php }
                                                                    ?>
                                                                </ul>
                                                                <audio id="audio"  tabindex="0" controls="" >
                                                                    <source src="<?php echo $FRNT_DOMAIN_NAME; ?>upload/music/<?php echo $timelineArg[0]; ?>">
                                                                </audio>
                                                                <p class="tracktitle"><?php echo $timelineArg[0]; ?></p>
                                                                <script>
                                                                    $(document).ready(function () {
                                                                        init();
                                                                        function init() {
                                                                            var current = 0;
                                                                            var audio = $('#audio');
                                                                            var playlist = $('#playlist');
                                                                            var tracks = playlist.find('li a');
                                                                            var len = tracks.length;
                                                                            audio[0].volume = .10;
                                                                            audio[0].play();
                                                                            playlist.on('click', 'a', function (e) {
                                                                                e.preventDefault();
                                                                                link = $(this);
                                                                                current = link.parent().index();
                                                                                run(link, audio[0]);
                                                                            });
                                                                            audio[0].addEventListener('ended', function (e) {
                                                                                current++;
                                                                                if (current == len) {
                                                                                    current = 0;
                                                                                    link = playlist.find('a')[0];
                                                                                } else {
                                                                                    link = playlist.find('a')[current];
                                                                                }
                                                                                run($(link), audio[0]);
                                                                            });
                                                                        }
                                                                        function run(link, player) {
                                                                            player.src = link.attr('href');
                                                                            var name = link.data('name');
                                                                            $('.tracktitle').html(name);
                                                                            par = link.parent();
                                                                            par.addClass('active').siblings().removeClass('active');
                                                                            player.load();
                                                                            player.play();
                                                                        }
                                                                    });
                                                                </script>
                                                            <?php } ?>
                                                            <?php
                                                        } else if ($catdetail['id'] == '13' || $catdetail['id'] == '14' || $catdetail['id'] == '15') {
                                                            ?>
                                                            <div class="row sub-tabs">
                                                                <ul class="nav nav-tabs subtabul<?php echo $catdetail['id']; ?>">
                                                                    <?php
                                                                    $subcatslist = $controller_class->getsubcategorylistbyusercatids($usrdetails['id'], $catdetail['id']);
                                                                    foreach ($subcatslist as $skey => $subcats):
                                                                        if ($skey == 0):
                                                                            $firstsubcat = $subcats['id'];
                                                                        endif;
                                                                        ?>
                                                                        <li <?php echo $skey == 0 ? " class='active'" : ""; ?> id = "subtabli<?php echo $subcats['id']; ?>"><a data-toggle="tab" href="#prvsubtab" onClick="loadsubcatimages('<?php echo $subcats['id']; ?>', '<?php echo $catdetail['id']; ?>')"><?php echo $subcats['sub_category_title']; ?></a>  </li>
                                                                    <?php endforeach; ?>
                                                                    <li <?php if (empty($subcatslist)): ?> class="active" <?php endif; ?> id = "subtabli-all-<?php echo $catdetail['id']; ?>"><a data-toggle="tab" href="#prvsubtab" onClick="loadsubcatimages('0', '<?php echo $catdetail['id']; ?>')" title="Add new sub category">All Other</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm-12" id="sortable<?php echo $catdetail['id']; ?>">
                                                                <?php
                                                                $modcnt = 0;
                                                                $imglist = $controller_class->getartistimagelistbycatid($catdetail['id']);
// $imglist = $controller_class->getimagesbySubcatCatUserid($usrdetails['id'], $catdetail['id'], $firstsubcat);
                                                                if (!empty($imglist)):
                                                                    foreach ($imglist as $k => $imgsdata):
                                                                        ?>
                                                                        <div class="col-lg-3 col-md-3 col-xs-6 preview-item ui-state-default" style="min-height: 225px; background-image: url('<?php echo $_SESSION['SITE_NAME'] . "upload/images/300/" . $imgsdata['image']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" data-tabval="<?php echo $imgsdata['id']; ?>">
                                                                            <a href="javascript:void(0)" id="dwn<?php echo $imgsdata['id']; ?>" onClick="openusermusicinpopup('<?php echo $imgsdata['id']; ?>')" class="openpop-link">&nbsp;</a>
                                                                            &nbsp; 
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <div class="callout callout-info">
                                                                        <h4>No Image Found</h4>
                                                                        <p><i class="fa fa-info-circle"></i> There is no image under this category to show.</p>            
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php }else {
                                                            ?>
                                                            <div class="row sub-tabs">
                                                                <ul class="nav nav-tabs subtabul<?php echo $catdetail['id']; ?>">
                                                                    <?php
                                                                    $subcatslist = $controller_class->getsubcategorylistbyusercatids($usrdetails['id'], $catdetail['id']);
                                                                    foreach ($subcatslist as $skey => $subcats):
                                                                        if ($skey == 0):
                                                                            $firstsubcat = $subcats['id'];
                                                                        endif;
                                                                        ?>
                                                                        <li <?php echo $skey == 0 ? " class='active'" : ""; ?> id = "subtabli<?php echo $subcats['id']; ?>"><a data-toggle="tab" href="#prvsubtab" onClick="loadsubcatimages('<?php echo $subcats['id']; ?>', '<?php echo $catdetail['id']; ?>')"><?php echo $subcats['sub_category_title']; ?></a>  </li>
                                                                    <?php endforeach; ?>
                                                                <!--<li <?php if (empty($subcatslist)): ?> class="active" <?php endif; ?> id = "subtabli-all-<?php echo $catdetail['id']; ?>"><a data-toggle="tab" href="#prvsubtab" onclick="loadsubcatimages('0', '<?php echo $catdetail['id']; ?>')" title="Add new sub category">All Other</a></li>-->
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm-12" id="sortable<?php echo $catdetail['id']; ?>">
                                                                <?php
                                                                $modcnt = 0;
//$imglist = $controller_class -> getartistimagelistbycatid($catdetail['id']);
                                                                $imglist = $controller_class->getimagesbySubcatCatUserid($usrdetails['id'], $catdetail['id'], $firstsubcat);
                                                                if (!empty($imglist)):
                                                                    foreach ($imglist as $k => $imgsdata):
                                                                        ?>
                                                                        <div class="col-lg-3 col-md-3 col-xs-6 preview-item ui-state-default" style="min-height: 225px; background-image: url('<?php echo $_SESSION['SITE_NAME'] . "upload/images/300/" . $imgsdata['image']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" data-tabval="<?php echo $imgsdata['id']; ?>">
                                                                            <a href="javascript:void(0)" onClick="openuserimageinpopup('<?php echo $imgsdata['id']; ?>')" class="openpop-link">&nbsp;</a>
                                                                            &nbsp; 
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <div class="callout callout-info">
                                                                        <h4>No Image Found</h4>
                                                                        <p><i class="fa fa-info-circle"></i> There is no image under this category to show.</p>            
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="callout callout-info">
                                                    <h4>No Category Selected</h4>
                                                    <p><i class="fa fa-info-circle"></i> Please select category from your profile page inside 'Preview Page Settings' box.</p>            
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (isMobile()) { ?>
                                            <!--<div class="sticky">-->
                                            <div class="col-lg-3 col-md-3 col-xs-12 sidebar_right no_pd_sticky">
                                                <div class="column col-md-12 div_marginsidebar"  style="margin-top:15px">
                                                    <?php
                                                    if ($artistpagedata['preview_sidebar'] != ''):
                                                        echo $artistpagedata['preview_sidebar'];
                                                    endif;
                                                    ?>
                                                </div>
                                            </div>
                                            <!--</div>-->
                                        <?php } ?>
                                    </div>
                                    <?php if (!isMobile()) { ?>
                                        <!--  <div class="sticky1 sidebar_right1">-->
                                        <div class="col-lg-3 col-md-3 col-xs-12 sidebar_right">
                                            <div class='column col-md-12 div_marginsidebar mgt40' >
                                                <?php
                                                if ($artistpagedata['preview_sidebar'] != ''):
                                                    echo $artistpagedata['preview_sidebar'];
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                        <!-- </div>-->
                                    <?php } ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class='column'>
                                    <?php
                                    if ($artistpagedata['preview_footer'] != ''):
                                        echo $artistpagedata['preview_footer'];
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section><!-- /.content -->
                </aside><!-- /.right-side -->
            </div><!-- ./wrapper -->
            <?php
            if ($forembed == "") {
                include('footernew.php');
            }
            ?>
        </div>
    </div>
    <!-- Popup -->
    <div id="inline-pop-usr-img" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row" id="usrimgpopcntrow"></div>
    </div>
    <div id="inline-pop-usr-music" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row" id="usrimgpopmusic"></div>
    </div>
    <!-- End Popup -->
    <!--<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>views/javascripts/homescript.js" type="text/javascript"></script>-->
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/jquery-ui/jquery-ui.css">
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/jquery-ui/jquery-ui.js"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/stickyfill.js"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
    <!-- datepicker js -->
    <style>
        div.preview-container { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }
        /*div.preview-item { margin: 5px; padding: 5px; width: 150px }*/
    </style>
    <script>
                                                            $(function () {
<?php
if (!empty($previewcategories) && $previewcategories[0] != ''):
    foreach ($previewcategories as $key => $prvcat):
        $catdetail = $controller_class->getartistcategorydetailbyid($prvcat);
        ?>
                                                                        $("#sortable<?php echo $catdetail['id']; ?>").sortable({
                                                                            disabled: true
                                                                        });
    <?php endforeach; ?>
<?php endif; ?>
                                                                $("div.preview-container, div.preview-item").disableSelection();
                                                            });
                                                            function loadsubcatimages(subcat, cat) {
                                                                $.ajax({
                                                                    method: "POST",
                                                                    url: site_url + "controllers/ajax_controller/artistpreview-ajax-controller.php",
                                                                    data: {loadsubcatimageschk: "loadsubcatimageschk", subcat: subcat, cat: cat}
                                                                })
                                                                        .done(function (data) {
                                                                            //alert("back to tab");
                                                                            $("#sortable" + cat).html(data);
                                                                            $("#sortable" + cat).sortable("refresh");
                                                                        });
                                                                return false;
                                                            }
                                                            function openuserimageinpopup(imgid) {
                                                                var usrimgid = imgid;
                                                                $.ajax({
                                                                    method: "POST",
                                                                    url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                                                                    data: {getuserimagedatachk: "getuserimagedatachk", usrimgid: usrimgid}
                                                                })
                                                                        .done(function (data) {
                                                                            $.fancybox({
                                                                                autoSize: 'false',
                                                                                fitToView: 'false',
                                                                                width: 500,
                                                                                href: '#inline-pop-usr-img'
                                                                            });
                                                                            //alert(data);
                                                                            $("#usrimgpopcntrow").html(data);
                                                                            //MagicZoom.refresh();
                                                                            $(function () {
                                                                                var viewer = ImageViewer();
                                                                                $('.gallery-items').click(function () {
                                                                                    var imgSrc = this.src,
                                                                                            highResolutionImage = $(this).data('high-res-img');
                                                                                    viewer.show(imgSrc, highResolutionImage);
                                                                                });
                                                                            });
                                                                            $('input[name="daterange"]').daterangepicker({
                                                                                locale: {
                                                                                    format: 'YYYY-MM-DD'
                                                                                }
                                                                            });
                                                                        });
                                                                return false;
                                                            }
                                                            function paypalPayment(imgid) {
                                                                $("<div>Redirecting...........Please wait!</div>").insertAfter(".paypalPayment");
                                                                var usrimgid = imgid;
                                                                $.ajax({
                                                                    method: "POST",
                                                                    url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                                                                    data: {getuserimagedatachk: "getuserimagedatachk", usrimgid: usrimgid, paypal_redirect: "payment"}
                                                                })
                                                                        .done(function (data) {
                                                                            window.location = data;
                                                                        });
                                                                return false;
                                                            }
                                                            // Save bid start
                                                            function userbidsave(imgid) {
<?php if (!isset($_SESSION['po_userses']['flc_usrlogin_id']) && $_SESSION['po_userses']['flc_usrlogin_id'] == '') { ?>
                                                                    alert("Please login first");
                                                                    return false;
<?php }
?>
                                                                var usrimgid = imgid;
                                                                var bidvalue = $("#bidvalue").val();
                                                                $.ajax({
                                                                    method: "POST",
                                                                    url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                                                                    data: {saveuserbid: "saveuserbid", usrimgid: usrimgid, bidvalue: bidvalue}
                                                                })
                                                                        .done(function (data) {
                                                                            alert("Successfully save bid amount");
                                                                            $(".img-to-zoom").zoom({on: 'click'});
                                                                            $('input[name="daterange"]').daterangepicker({
                                                                                locale: {
                                                                                    format: 'YYYY-MM-DD'
                                                                                }
                                                                            });
                                                                        });
                                                                return false;
                                                            }
                                                            // Save bid end
                                                            // Save rent start
                                                            function userrentsave(imgid) {
<?php if (!isset($_SESSION['po_userses']['flc_usrlogin_id']) && $_SESSION['po_userses']['flc_usrlogin_id'] == '') { ?>
                                                                    alert("Please login first");
                                                                    return false;
<?php }
?>
                                                                var usrimgid = imgid;
                                                                var rentvalue = $("#rentvalue").val();
                                                                $.ajax({
                                                                    method: "POST",
                                                                    url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                                                                    data: {saveuserrent: "saveuserrent", usrimgid: usrimgid, rentvalue: rentvalue}
                                                                })
                                                                        .done(function (data) {
                                                                            alert("Successfully save rent date");
                                                                            $(".img-to-zoom").zoom({on: 'click'});
                                                                            $('input[name="daterange"]').daterangepicker({
                                                                                locale: {
                                                                                    format: 'YYYY-MM-DD'
                                                                                }
                                                                            });
                                                                        });
                                                                return false;
                                                            }
                                                            // Save rent end
                                                            function openusermusicinpopup(imgid) {
                                                                var usrimgid = imgid;
                                                                $.ajax({
                                                                    method: "POST",
                                                                    url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                                                                    data: {getusermusicdatachk: "getusermusicdatachk", usrimgid: usrimgid}
                                                                })
                                                                        .done(function (data) {
                                                                            //alert(data);
                                                                            $("#usrimgpopmusic").html(data);
                                                                            $.fancybox({
                                                                                href: '#inline-pop-usr-music'
                                                                            });
                                                                            $('input[name="daterange"]').daterangepicker({
                                                                                locale: {
                                                                                    format: 'YYYY-MM-DD'
                                                                                }
                                                                            });
                                                                        });
                                                                return false;
                                                            }
    </script>
    <?php if (isset($_SESSION['item_no']) && $_SESSION['item_no'] != '') { ?>
        <script type="text/javascript">
            jQuery(function () {
                var openpagemusic = '<?php echo $_SESSION['item_no']; ?>';
                jQuery('#dwn' + openpagemusic).click();
            });</script>
        <?php
        unset($_SESSION['item_no']);
    }
    ?>
    <?php if (isset($_GET['thirdid']) && $_GET['thirdid'] != '') { ?>
        <script type="text/javascript">
            $(document).ready(function () {
                var tobeselected = '<?php echo $_GET["thirdid"]; ?>';
                console.log(tobeselected);
                $("a[href=#prvtab" + tobeselected + "]").click();
                $('.radiohostplay').click(function () {
                    var url = window.location.href;
                    var url = url.slice(0, url.lastIndexOf('/'));
                    var id = $(this).attr('id');
                    window.location.href = url + "/" + id;
                })
            })
        </script>
    <?php } ?>
</body>