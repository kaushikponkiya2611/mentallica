<?php
//include '../background_drag/db.php';
session_start();
$session_uid = $_SESSION['po_userses']['flc_usrlogin_id']; // $_SESSION['user_id'];
//include '../background_drag/userUpdates.php';
//$userUpdates = new userUpdates($db);
$uid = $_SESSION['po_userses']['flc_usrlogin_id'];
if ((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist'] != '')) {
    $uid = $_SESSION['current_artist'];
}
$userData = $controller_class->userDetails($uid, $_GET["workid"]);

$getpreviewmusic = $controller_class->getpreviewmusic();
$getsavedmusic = $controller_class->getsavedmusic();

$profile_background = "my.jpg";
if (isset($userData['profile_background']) && !empty($userData['profile_background'])) {
    $profile_background = $userData['profile_background'];
}

$imageU = $controller_class->getuserdetailfromuserid($uid);



if (empty($imageU['image'])) {
    $profile_pic = $_SESSION['SITE_NAME'] . "upload/art/default.jpg";
} else {
    $profile_pic = $_SESSION['FRNT_DOMAIN_NAME'] . "upload/artist/" . $imageU['image'];
}



if (isset($userData['profile_pic']) && !empty($userData['profile_pic'])) {
    $profile_pic = $_SESSION['FRNT_DOMAIN_NAME'] . "upload/art/" . $userData['profile_pic'];
}

$profile_background_position = $userData['profile_background_position'];
?>
<link href='<?= $_SESSION['FRNT_DOMAIN_NAME'] ?>background_drag/timeline.css' rel='stylesheet' type='text/css'/>
<!--<script src="../background_drag/js/jquery.min.js"></script>
<script src="../background_drag/js/jquery-ui.min.js"></script>-->
<script src="<?= $_SESSION['FRNT_DOMAIN_NAME'] ?>background_drag/js/jquery.wallform.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/jquery-ui/jquery-ui.css">
<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>

<style>
    div.preview-container { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }

</style>

<script src="<?= $_SESSION['FRNT_DOMAIN_NAME'] ?>crop/dist_files/jquery.imgareaselect.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?= $_SESSION['FRNT_DOMAIN_NAME'] ?>crop/dist_files/imgareaselect.css">
<!--<script src="../crop/functions.js"></script>-->
<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>views/javascripts/functions.js" type="text/javascript"></script>
<body class="skin-blue">
    <div class="container">
        <div class="row blue-border-main">
            <!-- header logo: style can be found in header.less -->
            <?php require_once($_SESSION['APP_PATH'] . "views/header.php");
            ?>
            <div class="wrapper row-offcanvas row-offcanvas-left">


                <!-- Right side column. Contains the navbar and content of the page -->
                <aside class="right-side strech">


                    <!-- Main content -->
                    <section class="content">

                        <div class="container">

                            <!-- Content Header (Page header) -->
                            <!--<section class="content-header">
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">Preview</li>
                                </ol>
                            </section>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">Preview Page
                                        <small>This is you preview page.</small>
                                    </h1>
        
                                </div>
        
                            </div>-->
                            <?php
                            $sidebar = 0;
                            if ((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist'] != '')) {
                                $sidebar = $controller_class->checkcompanypageAccess('sidebar_access');
                            } else {
                                $sidebar = 1;
                            }

                            if ($sidebar == 1) {
                                ?>
                                <div class="row artistpreview-btn-wrapper">
                                    <div class="col-lg-12  artistpreview-btn" id="actiontoall" >
                                        <button style="float:right;margin-left:14px" onclick="showembedcode()" class="btn btn-primary">Show Embed Code</button>
                                        <button  style="float:right" onClick="starteditall()" class="btn btn-primary">Start editing</button>
                                    </div>
                                </div>
                                <?php
                            } else {
                                echo "<br/>";
                            }
                            ?>
                            <!-- /.row -->

                            <div class="row cf">
                                <div class="col-lg-9 col-md-9 col-xs-12" style="padding: 0;">


                                    <div class="row menu">
                                        <div class="col-lg-12 links">
                                            <div class="links-outer">
                                                <ul class="nav nav-tabs test-links">

                                                    <?php
                                                    $subcat = $controller_class->getpreviewcategories['preview_category'];
                                                    if ((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist'] != '')) {
                                                        $subcat = $controller_class->getcompanypageCatAccess();
                                                        if ($subcat != 'empty') {
                                                            $subcat = $subcat;
                                                        }
                                                    }




                                                    //$previewcategorylist = $controller_class->getcategorylistbyids($controller_class->getpreviewcategories['preview_category']);
                                                    $previewcategorylist = $controller_class->getcategorylistbyids($subcat);
                                                    $previewcategories = array();
                                                    foreach ($previewcategorylist as $k => $catlist) {
                                                        $previewcategories[] = $catlist['id'];
                                                    }
                                                    if (!isset($_GET["workid"]) && empty($_GET["workid"])) {
                                                        $_GET["workid"] = $previewcategories[0];
                                                    }

                                                    if (!empty($previewcategories) && $previewcategories[0] != ''):
                                                        $keycall = '';
                                                        foreach ($previewcategories as $key => $prvcat):
                                                            $catdetail = $controller_class->getcategorydetailbyid($prvcat);
                                                            if ($key == 0) {
                                                                $keycall = $catdetail['id'];
                                                            }
                                                            ?>
                                                            <li <?php echo $key == 0 ? " class='active'" : ""; ?>><a data-toggle="tab" onClick="settabajaxsidebar('<?= $catdetail['id'] ?>')" href="#prvtab<?php echo $catdetail['id']; ?>" class="radiohostplay" id="<?php echo $catdetail['id']; ?>"><?php echo $catdetail['categoryName']; ?></a></li>
                                                        <?php endforeach; ?>
                        <!--<li><a data-toggle="tab" href="#hidimg"><i class="fa fa-undo"></i> Hidden Images</a></li>-->
                                                    <?php endif; ?>                                        

                                                </ul>
                                                <div class="more">
                                                    <span class="show-xs"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                    <span class="hidden-xs"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                    <ul class="links-hidden nav nav-tabs"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Projects Row -->
                                    <div class="row preview-container tab-content" id="sortable">
                                        <?php
                                        $firstsubcat = 0;
                                        $firstcatid = "";
                                        //$catdetail = 
                                        if (!empty($previewcategories) && $previewcategories[0] != ''):
                                            foreach ($previewcategories as $key => $prvcat):
                                                $catdetail = $controller_class->getcategorydetailbyid($prvcat);
                                                ?>
                                                <div id="prvtab<?php echo $catdetail['id']; ?>"  class="tab-pane fade <?php echo $key == 0 ? " in active" : ""; ?>">

                                                    <?php $artistpagedata = $controller_class->getartistpreivepagedatacategory($uid, $catdetail['id']); ?>

                                                    <div id="section_cat<?= $previewcategories[$key] ?>">
                                                        <?php
                                                        //if ($catdetail['id'] == $_GET["workid"]) {
                                                        $firstcatid .= $catdetail['id'];
                                                        ?>





                                                        <div id="profile_pic_modal" class="bannerModal_<?php echo $catdetail['id'] ?>  modal fade">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h3>Change Banner Picture</h3>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="cropimage<?php echo $catdetail['id'] ?>" method="post" enctype="multipart/form-data" action="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>controllers/ajax_controller/change_pic.php">
                                                                            <strong>Upload Image:</strong> <br><br>
                                                                            <input type="file" name="profile-pic" class="profile-pic" data-id="<?php echo $catdetail['id'] ?>" id="profile-pic-<?php echo $catdetail['id'] ?>" />
                                                                            <input type="hidden" name="hdn-profile-id" id="hdn-profile-id<?php echo $catdetail['id'] ?>" value="1" />
                                                                            <input type="hidden" name="hdn-x1-axis" id="hdn-x1-axis<?php echo $catdetail['id'] ?>" value="" />
                                                                            <input type="hidden" name="hdn-y1-axis" id="hdn-y1-axis<?php echo $catdetail['id'] ?>" value="" />
                                                                            <input type="hidden" name="hdn-x2-axis" value="" id="hdn-x2-axis<?php echo $catdetail['id'] ?>" />
                                                                            <input type="hidden" name="hdn-y2-axis" value="" id="hdn-y2-axis<?php echo $catdetail['id'] ?>" />
                                                                            <input type="hidden" name="hdn-thumb-width" id="hdn-thumb-width<?php echo $catdetail['id'] ?>" value="" />
                                                                            <input type="hidden" name="hdn-thumb-height" id="hdn-thumb-height<?php echo $catdetail['id'] ?>" value="" />
                                                                            <input type="hidden" name="catid" value="<?php echo $catdetail['id'] ?>" id="" />
                                                                            <input type="hidden" name="ajaxurl" id="ajaxurl<?php echo $catdetail['id'] ?>" value="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>controllers/ajax_controller/change_pic.php?action=save"/>
                                                                            <input type="hidden" name="action" value="" id="action" />
                                                                            <input type="hidden" name="image_name" value="" id="image_name<?php echo $catdetail['id'] ?>" />

                                                                            <div id='preview-profile-pic<?php echo $catdetail['id'] ?>'></div>
                                                                            <div id="thumbs" style="padding:5px; width:600p"></div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="button" data-catid="<?php echo $catdetail['id'] ?>" id="save_crop<?php echo $catdetail['id'] ?>" class="save_crop btn btn-primary">Crop & Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div id="model_embedcode" class="modal fade">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h3>Embed Code</h3>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <textarea style="width:100%;resize: none;"><iframe src="<?= $_SESSION['FRNT_DOMAIN_NAME'] . "yxjaxnchjldmllw/" . $imageU["username"] ?>" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe></textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                    

                                                        <div class="clearfix" style="margin-top:20px"></div>
                                                        <div id="introduction____">
                                                            <div id="timelineContainer" style="margin-top:10px">

                                                                <!-- timeline background -->
                                                                <div id="timelineBackground" class="timelineBackground<?php echo $catdetail['id'] ?>">
                                                                    <?php
                                                                    $userData = $controller_class->userDetails($uid, $catdetail['id']);
                                                                    $profile_background = "my.jpg";

                                                                    if (isset($userData['profile_background']) && !empty($userData['profile_background'])) {
                                                                        $profile_background = $userData['profile_background'];
                                                                    }
                                                                    $profile_background_position = $userData['profile_background_position'];
                                                                    ?>
                                                                    <img src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'] . "upload/art/" . $profile_background; ?>" class="bgImage" id="bgImage<?php echo $catdetail['id'] ?>" style="margin-top: <?php echo $profile_background_position; ?>;">
                                                                </div>

                                                                <!-- timeline background -->
                                                                <div style="background:url(<?= $_SESSION['FRNT_DOMAIN_NAME'] ?>background_drag/images/timeline_shade.png);" class="timelineShade<?php echo $catdetail['id'] ?>" id="timelineShade">
                                                                    <!--<form id="bgimageform" method="post" enctype="multipart/form-data" action="controllers/ajax_controllerimage_upload_ajax.php">-->
                                                                    <div style="margin-top:60px">
                                                                        <!--<img class="img-circle" id="profile_picture" height="128" data-src="default.jpg"  data-holder-rendered="true" style="width: 140px; height: 140px;" src="../crop/default.jpg"/>
                                                                        <br><br>-->

                                                                        <a type="button" style="float:right" class="btn btn-primary change-profile-pic" data-cat="<?php echo $catdetail['id'] ?>" id="change-profile-pic<?php echo $catdetail['id'] ?>">Change Banner Picture</a>
                                                                    </div>
                                                                    <div style="display:none"  class="uploadFile timelineUploadBG">
                                                                        <!--<input type="button" name="photoimg" >-->

                                                                        <div id="bgphotoimg" onClick="$('#hid_profileImage2').click()" class=" custom-file-input" original-title="Change Cover Picture"></div>
                                                                    </div>
                                                                    <!--</form>-->
                                                                </div>
                                                                <div style="width:0px; height:0px; overflow:hidden;">
                                                                    <form action="" class="form_profileimage1_<?= $catdetail['id'] ?>" id="form_profileimage1_<?= $catdetail['id'] ?>" name="form_profileimage1" method="post" enctype="multipart/form-data">
                                                                        <input name="hid_profileImage1" id="hid_profileImage1_<?= $catdetail['id'] ?>" onChange="ProfileImage1(<?= $catdetail['id'] ?>)" type="file">
                                                                        <input id="uploadImage1" name="uploadImage1" value="uploadImage1" type="hidden">
                                                                        <input id="hid_catid<?= $catdetail['id'] ?>" name="hid_catid" value="<?= $catdetail['id'] ?>" type="hidden">
                                                                    </form>
                                                                </div>
                                                                <div style="width:0px; height:0px; overflow:hidden;">
                                                                    <form action="" id="form_profileimage" name="form_profileimage" method="post" enctype="multipart/form-data">
                                                                        <input name="hid_profileImage2" id="hid_profileImage<?= $catdetail['id'] ?>" onChange="ProfileImage(<?= $catdetail['id'] ?>)" type="file">
                                                                        <input id="uploadImage" name="uploadImage" value="uploadImage" type="hidden">
                                                                        <input id="hid_catid<?= $catdetail['id'] ?>" name="hid_catid" value="<?= $catdetail['id'] ?>" type="hidden">
                                                                    </form>
                                                                </div>

                                                                <!-- timeline profile picture -->
                                                                <div id="timelineProfilePic">
                                                                    <?php
                                                                    $profile = $controller_class->getcategorydetailbyUserId($uid, $catdetail['id']);
                                                                    if ($profile['profile_pic'] != '') {
                                                                        $profile_pic = $_SESSION['FRNT_DOMAIN_NAME'] . 'upload/art/' . $profile['profile_pic'];
                                                                    } else if ($catdetail['categoryImage'] != '') {
                                                                        $profile_pic = $_SESSION['FRNT_DOMAIN_NAME'] . 'upload/category/' . $catdetail['categoryImage'];
                                                                    } else {
                                                                        $profile_pic = $_SESSION['FRNT_DOMAIN_NAME'] . "upload/art/my.jpg";
                                                                    }
                                                                    ?>
                                                                    <img class="custom-file-input" id="profile_picture_<?php echo $catdetail['id'] ?>"  src="<?php echo $profile_pic; ?>" style="width:100%; height:100%;" >
                                                                    <a type="button" style="margin-top:-57px; position: relative;" onClick="$('#hid_profileImage1_<?= $catdetail['id'] ?>').click()"  class="btn btn-primary" >Change Profile Picture</a>
                                                                </div>

                                                                <!-- timeline title -->
                                                                <div id="timelineTitle"><?php echo $name; ?></div>

                                                                <!-- timeline nav -->
                                                                <div id="timelineNav"></div>

                                                            </div>

                                                            <?php /* ?><?php 
                                                              if($artistpagedata['preview_header'] != ''):
                                                              echo $artistpagedata['preview_header'];

                                                              else: ?>
                                                              <img alt="" src="/ckfinder/userfiles/images/bannerdesign2.jpg" height="230" width="874">
                                                              <h2>My Preview Page<br></h2>
                                                              <p>You can see my work here in this page.<br></p>
                                                              <?php endif; ?> <?php */ ?> 
                                                        </div>
                                                        <div class='col-md-12'>
                                                            <button id="toggle" style="display:none" class="btn btn-primary">Start editing</button>
                                                            <button id="reset" style="display:none" class="btn btn-primary" >Reset content</button>

                                                            <input type="hidden" id="hid_catid<?= $catdetail['id'] ?>" name="hid_catid" value="<?= $_GET["workid"] ?>">
                                                            <br/><br/>
                                                        </div>

                                                        <?php
                                                        //}
                                                        ?>
                                                    </div>	
                                                    <!--<div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>&nbsp;</label>
                                                                <select class="form-control" onchange="getallvisiblechkbox(this)" data-selcatdata="<?php echo $catdetail['id']; ?>">
                                                                    <option value="">Select Action</option>
                                                                    <option value="move">Move To</option>
                                                                    <option value="add">Add To</option>
                                                                    <option value="remove">Remove</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                    <div class="row sub-tabs">
                                                        <ul class="nav nav-tabs subtabul<?php echo $catdetail['id']; ?>">
                                                            <?php
                                                            $subcatacc = 0;
                                                            if ((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist'] != '')) {
                                                                $subcatacc = $controller_class->checkcompanypageAccess('sub_category_access');
                                                            } else {
                                                                $subcatacc = 1;
                                                            }

                                                            if ($subcatacc == 1) {
                                                                $subcatslist = $controller_class->getsubcategorylistbyusercatids($uid, $catdetail['id']);
                                                                $im = 0;
                                                                foreach ($subcatslist as $skey => $subcats):
                                                                    if ($skey == 0):
                                                                        $firstsubcat = $subcats['id'];
                                                                    endif;
                                                                    if ((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist'] != '')) {
                                                                        $subcat = $controller_class->getcompanypageSubCatAccess();
                                                                        $sub = explode(",", $subcat);
                                                                        if (in_array($subcats['id'], $sub)) {
                                                                            if ($im == 0) {
                                                                                $firstsubcat = $subcats['id'];
                                                                            }
                                                                            ?>
                                                                            <li <?php echo $im == 0 ? " class='active'" : ""; ?> id = "subtabli<?php echo $subcats['id']; ?>"><a data-toggle="tab" href="#prvsubtab" onClick="loadsubcatimages('<?php echo $subcats['id']; ?>', '<?php echo $catdetail['id']; ?>')"><?php echo $subcats['sub_category_title']; ?> &nbsp;&nbsp;&nbsp; <i class="fa fa-times curs-pointer fancybox" href="#inline-pop-dlt-subcat" aria-hidden="true" onClick="opendltsubcatpopup('<?php echo $subcats['id']; ?>', '<?php echo $catdetail['id']; ?>')"></i> </a>  </li>
                                                                            <?php
                                                                            $im++;
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <li <?php echo $skey == 0 ? " class='active'" : ""; ?> id = "subtabli<?php echo $subcats['id']; ?>"><a data-toggle="tab" href="#prvsubtab" onClick="loadsubcatimages('<?php echo $subcats['id']; ?>', '<?php echo $catdetail['id']; ?>')"><?php echo $subcats['sub_category_title']; ?> &nbsp;&nbsp;&nbsp; <i class="fa fa-times curs-pointer fancybox" href="#inline-pop-dlt-subcat" aria-hidden="true" onClick="opendltsubcatpopup('<?php echo $subcats['id']; ?>', '<?php echo $catdetail['id']; ?>')"></i> </a>  </li>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                endforeach;
                                                            }
                                                            ?>
                                                            <li <?php if (empty($subcatslist)): ?> class="active" <?php endif; ?> id = "subtabli-all-<?php echo $catdetail['id']; ?>"><a data-toggle="tab" href="#prvsubtab" onClick="loadsubcatimages('0', '<?php echo $catdetail['id']; ?>')" title="Add new sub category">Hidden pictures</a></li>

                                                            <?php
                                                            if (isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 1) {
                                                                ?>
                                                                <li><a href="#inline-pop-add-subcategory" onClick="openaddsubcatpopup('<?php echo $catdetail['id']; ?>')" title="Add new sub category" class="fancybox"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                                                <?php
                                                            }
                                                            ?>

                                                        </ul>
                                                    </div>

                                                    <div class="ssssss" id="sortable<?php echo $catdetail['id']; ?>">

                                                        <?php if ($catdetail['id'] != '16') { ?>

                                                            <?php
                                                            $modcnt = 0;
                                                            //$imglist = $controller_class -> getuserimagelistbycatid($catdetail['id']);

                                                            $imglist = $controller_class->getimagesbySubcatCatUserid($uid, $catdetail['id'], $firstsubcat);
                                                            if (!empty($imglist)):
                                                                foreach ($imglist as $k => $imgsdata):
                                                                    ?>
                                                                    <div class="col-lg-3 col-md-3 col-xs-6 preview-item ui-state-default" style="min-height: 225px; background-image: url('<?php echo $_SESSION['SITE_NAME'] . "upload/images/300/" . $imgsdata['image']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" data-tabval="<?php echo $imgsdata['id']; ?>">
                                                                        <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'] . "editimage/" . $imgsdata['id']; ?>"><i class="fa fa-pencil-square-o edit-icon" title="Edit image"></i></a>
                                                                        <i class="fa fa-times-circle remove-cross" title="Hide image"></i>
                                                                        <a href="javascript:void(0)" onClick="openuserimageinpopup('<?php echo $imgsdata['id']; ?>')" class="openpop-link">&nbsp;</a>
                                                                        <!--<a>
                                                                            <img src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/300/" . $imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                                                                        </a>

                                                                        <h3>
                                                                        <?php echo $imgsdata['img_title']; ?>
                                                                        </h3>  -->  
                                                                        <!--<input type="checkbox" id="imgchk<?php echo $imgsdata['id']; ?>" class="actionchk" title="Select" value="<?php echo $imgsdata['id']; ?>" />-->
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <div class="callout callout-info">
                                                                    <h4>No Image Found</h4>
                                                                    <p><i class="fa fa-info-circle"></i> There is no image under this category to show.</p>            
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php }else { ?>
                                                            <?php //if(!empty($getpreviewmusic)){ ?>
                                                            <ul id="sortablemusic">


                                                                <?php foreach ($getsavedmusic as $key1 => $musicData1) { ?>
                                                                    <li class="ui-state-default">
                                                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>

                                                                        <input checked="checked" class="rhostmusiccls" id="checkbox_<?php echo $key1; ?>" type="checkbox" name="rhostmusic[]" value="<?php echo $musicData1; ?>">
                                                                        <label for="checkbox_<?php echo $key1; ?>"><?php echo $musicData1; ?></label>

                                                                    </li>


                                                                <?php } ?>

                                                                <?php foreach ($getpreviewmusic as $key => $musicData) { ?>
                                                                    <?php if (!in_array($musicData, $getsavedmusic)) { ?>
                                                                        <li class="ui-state-default">
                                                                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>

                                                                            <input class="rhostmusiccls" id="checkbox_<?php echo $key; ?>" type="checkbox" name="rhostmusic[]" value="<?php echo $musicData; ?>">
                                                                            <label for="checkbox_<?php echo $key; ?>"><?php echo $musicData; ?></label>

                                                                        </li>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </ul>
                                                            <span class="saveradiohost">Save</span>
                                                            <?php //}  ?>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <div id="hidimg" class="tab-pane fade">


                                                <div class="" id="sortable-hid">
                                                    <?php
                                                    $modcnt = 0;
                                                    $imglist = $controller_class->getuserimageinactivelistbycatid();
                                                    if (!empty($imglist)):
                                                        foreach ($imglist as $key => $imgsdata):
                                                            ?>
                                                            <div class="col-lg-3 col-md-3 col-xs-6 preview-item ui-state-default" style="min-height: 225px; background-image: url('<?php echo $_SESSION['SITE_NAME'] . "upload/images/300/" . $imgsdata['image']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" data-backto="sortable<?php echo $imgsdata['category_id']; ?>" data-tabval="<?php echo $imgsdata['id']; ?>">
                                                                <a href="<?php echo $_SESSION['SITE_NAME']; ?>editimage/<?php echo $imgsdata['id']; ?>"><i class="fa fa-pencil-square-o edit-icon" title="Edit image"></i></a>
                                                                <i class="fa fa-undo undo-cross" title="Restore image"></i>
                                                                <a href="javascript:void(0)" onClick="openuserimageinpopup('<?php echo $imgsdata['id']; ?>')" class="openpop-link">&nbsp;</a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <div class="callout callout-info">
                                                            <h4>No Image Found</h4>
                                                            <p><i class="fa fa-info-circle"></i> There is no hidden image to show.</p>            
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="callout callout-info">
                                                <h4>No Category Selected</h4>
                                                <p><i class="fa fa-info-circle"></i> Please select category from your profile page inside 'Preview Page Settings' box.</p>            
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <?php
                                    //$artistpagedata = $controller_class->getartistpreivepagedatacategory($uid, $firstcatid);

                                 
                                    ?>

                                    <div class='col-md-12'>
                                        <button id="toggle_ft" style="display:none" class="btn btn-primary">Start editing</button>
                                        <button id="reset_ft" style="display:none" class="btn btn-primary">Reset content</button>
                                        <br/><br/>
                                    </div>
                                </div>

                                <?php
                                $sidebar = 0;
                                if ((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist'] != '')) {
                                    $sidebar = $controller_class->checkcompanypageAccess('sidebar_access');
                                } else {
                                    $sidebar = 1;
                                }
                                if ($sidebar == 1) {
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-xs-12 sidebar_right mgt40">
                                        <div id="section_sidebarpart">
                                            <input type="hidden" id="hid_catidsidebar" name="hid_catidsidebar" value="<?= $firstcatid ?>">
                                            <div class="column col-md-12" id="introduction_sb">
                                                <?php //endif;      ?>
                                            </div>
                                            <div class='col-md-12'>
                                                <button id="toggle_sb" style="display:none" class="btn btn-primary">Start editing</button>
                                                <button id="reset_sb" style="display:none" class="btn btn-primary">Reset content</button>
                                                <br/><br/>
                                            </div>

                                            <script>
                                                $(document).ready(function () {

                                                    $('.saveradiohost').on('click', function () {

                                                        var favorite = [];
                                                        $.each($(".rhostmusiccls:checked"), function () {
                                                            favorite.push($(this).val());
                                                        });
                                                        $.ajax({
                                                            url: '<?php echo $_SESSION['ADMIN_DOMAIN_NAME']; ?>' + '/controllers/ajax_controller/save-radio-host.php',
                                                            type: 'post',
                                                            context: this,
                                                            data: 'timeline=' + JSON.stringify(favorite),
                                                            success: function (resp) {
                                                                $(this).html('Save');
                                                                alert('Timeline save!!');
                                                            },
                                                            error: function (resp) {
                                                                alert('Action counld not complete at this moment!!!');
                                                            }
                                                        });
                                                    })


                                                            // Sample: Inline Editing Enabled by Code
                                                                    (function () {
                                                                        var isEditingEnabled_SB,
                                                                                toggle_sb = document.getElementById('toggle_sb'),
                                                                                reset_sb = document.getElementById('reset_sb'),
                                                                                introduction_sb = document.getElementById('introduction_sb'),
                                                                                introduction_sbHTML = introduction_sb.innerHTML;

                                                                        function enable_sbEditing() {
                                                                            if (!CKEDITOR.instances.introduction_sb) {
                                                                                CKEDITOR.inline('introduction_sb', {
                                                                                    extraPlugins: 'uploadimage,image2',
                                                                                    height: 300,
                                                                                    uploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                                                                                    filebrowserBrowseUrl: '/projectone/ckfinder/ckfinder.html',
                                                                                    filebrowserImageBrowseUrl: '/projectone/ckfinder/ckfinder.html?type=Images',
                                                                                    filebrowserUploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                                                    filebrowserImageUploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                                                    stylesSet: [
                                                                                        {name: 'Narrow image', type: 'widget', widget: 'image', attributes: {'class': 'image-narrow'}},
                                                                                        {name: 'Wide image', type: 'widget', widget: 'image', attributes: {'class': 'image-wide'}}
                                                                                    ],
                                                                                    // Load the default contents.css file plus customizations for this sample.
                                                                                    contentsCss: [CKEDITOR.basePath + 'contents.css', 'https://sdk.ckeditor.com/samples/assets/css/widgetstyles.css'],
                                                                                    // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
                                                                                    // resizer (because image size is controlled by widget styles or the image takes maximum
                                                                                    // 100% of the editor width).
                                                                                    image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
                                                                                    image2_disableResizer: true
                                                                                });
                                                                            }
                                                                        }

                                                                        function disable_sbEditing() {
                                                                            if (CKEDITOR.instances.introduction_sb)
                                                                                CKEDITOR.instances.introduction_sb.destroy();
                                                                        }

                                                                        function toggle_sbEditor() {
                                                                            if (isEditingEnabled_SB) {
                                                                                if (CKEDITOR.instances.introduction_sb && CKEDITOR.instances.introduction_sb.checkDirty()) {
                                                                                    reset_sb.style.display = 'inline';
                                                                                }
                                                                                disable_sbEditing();
                                                                                introduction_sb.setAttribute('contenteditable', false);
                                                                                this.innerHTML = 'Start editing';
                                                                                isEditingEnabled_SB = false;
                                                                                save_sbContent(introduction_sb.innerHTML);
                                                                            } else {
                                                                                introduction_sb.setAttribute('contenteditable', true);
                                                                                enable_sbEditing();
                                                                                this.innerHTML = 'Finish editing';
                                                                                isEditingEnabled_SB = true;
                                                                            }
                                                                        }

                                                                        function reset_sbContent() {
                                                                            reset_sb.style.display = 'none';
                                                                            introduction_sb.innerHTML = introduction_sbHTML;
                                                                            save_sbContent(introduction_sb.innerHTML);
                                                                        }

                                                                        function onClick_sb(element, callback) {
                                                                            if (window.addEventListener) {
                                                                                element.addEventListener('click', callback, false);
                                                                            } else if (window.attachEvent) {
                                                                                element.attachEvent('onclick', callback);
                                                                            }
                                                                        }

                                                                        function save_sbContent(htmlcontent) {
                                                                            var cat = $("#hid_catidsidebar").val();

                                                                            $.post(site_url + 'controllers/ajax_controller/preview-save-sidebar-ajax-controller.php',
                                                                                    {content: htmlcontent, catid: cat}).done(function (data) {
                                                                                console.log("Saved Successfully.");
                                                                            });
                                                                        }

                                                                        onClick_sb(toggle_sb, toggle_sbEditor);
                                                                        onClick_sb(reset_sb, reset_sbContent);

                                                                    })();


                                                        });
                                            </script> 
                                        </div>
                                    </div>    
                                    <?php
                                }
                                ?>


                                <div class="clearfix"></div>


                            </div>

                            <div class='column col-md-12' id="introduction_ft">
                                <?php
                                
                                if ($artistpagedata['preview_footer'] != ''):
                                    echo $artistpagedata['preview_footer'];
                                else:
                                    ?>
                                    <h2>My Preview Page Footer<br></h2>
                                    <p>You can see my work here in this page.<br></p>
                                <?php endif; ?>
                            </div>                    

                        </div>
                    </section><!-- /.content -->
                </aside><!-- /.right-side -->
            </div><!-- ./wrapper -->
            <?php include('footernew.php'); ?>
        </div>
    </div>


    <!-- Popup -->
    <div id="inline-pop-add-subcategory" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 portfolio-item">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Sub Category</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form enctype="multipart/form-data" id="frm_add_subcategory" name="frm_add_subcategory" method="post" action="" role="form" onSubmit="return addnewsubcategory()">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="txt_subcat_title">Submenu Title</label>
                                <input type="text" required="" id="txt_subcat_title" name="txt_subcat_title" class="form-control">
                            </div>

                        </div><!-- /.box-body -->
                        <input type="hidden" name="stbcatcat" id="stbcatcat" />
                        <div class="box-footer">
                            <button name="btn_subcat" class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="inline-pop-dlt-subcat" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 portfolio-item">
                <div class="box box-primary">

                    <div class="box-body">

                        <div class="form-group">
                            <label for="txt_subcat_title">Are you sure you want to delete this sub category?</label>
                        </div>

                    </div><!-- /.box-body -->
                    <input type="hidden" name="dltstbcatcat" id="dltstbcatcat" />
                    <input type="hidden" name="prtcategory" id="prtcategory" />
                    <div class="box-footer">
                        <button name="btn_subcat" class="btn btn-primary" type="button" onClick="dltnewsubcategory()">Delete</button>
                        <button name="btn_subcat" class="btn btn-primary" type="button" onClick="$.fancybox.close();">Cancle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#inline-pop-bulkaction-cnf" class="fancybox" id="bulkactcnfatag" style="display:none;">&nbsp;</a>
    <div id="inline-pop-bulkaction-cnf" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 portfolio-item">
                <div class="box box-primary">
                    <form enctype="multipart/form-data" id="frm_bulkaction_cnf" name="frm_bulkaction_cnf" method="post" action="" role="form" onSubmit="return proccatbulkaction()">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="txt_subcat_title" id="bulkactcnfatag_lab"></label>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="bulkactcnfatag_sel" required >
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>

                        </div><!-- /.box-body -->
                        <input type="hidden" name="bulkactcnfatag_chklist" id="bulkactcnfatag_chklist" />
                        <input type="hidden" name="bulkactcnfatag_catdata" id="bulkactcnfatag_catdata" />
                        <input type="hidden" name="bulkactcnfatag_bulkact" id="bulkactcnfatag_bulkact" />
                        <div class="box-footer">
                            <button name="btn_subcat" id="bulkactcnfatag_btn" class="btn btn-primary" type="submit">Yes</button>
                            <button name="btn_subcat" class="btn btn-primary" type="button" onClick="$.fancybox.close();">Cancle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href="#inline-pop-actremove-cnf" class="fancybox" id="removesubcatimgcnfatag" style="display:none;">&nbsp;</a>
    <div id="inline-pop-actremove-cnf" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 portfolio-item">
                <div class="box box-primary">
                    <form enctype="multipart/form-data" id="frm_bulkaction_cnf" name="frm_bulkaction_cnf" method="post" action="" role="form" onSubmit="return procrmvimgfrmsubcat()">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="txt_subcat_title" id="removesubcatimgcnfatag_lab">Are you sure you want to remove selected image(s) from subcategory?</label>
                            </div>

                        </div><!-- /.box-body -->
                        <input type="hidden" name="removesubcatimgcnfatag_chklist" id="removesubcatimgcnfatag_chklist" />
                        <input type="hidden" name="removesubcatimgcnfatag_catdata" id="removesubcatimgcnfatag_catdata" />
                        <input type="hidden" name="removesubcatimgcnfatag_subcati" id="removesubcatimgcnfatag_subcati" />
                        <input type="hidden" name="removesubcatimgcnfatag_bulkact" id="removesubcatimgcnfatag_bulkact" />
                        <div class="box-footer">
                            <button name="btn_subcat" id="removesubcatimgcnfatag_btn" class="btn btn-primary" type="submit">Remove</button>
                            <button name="btn_subcat" class="btn btn-primary" type="button" onClick="$.fancybox.close();">Cancle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="inline-pop-usr-img" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row" id="usrimgpopcntrow"></div>
    </div>

    <!-- End Popup -->
    <script>
        $(document).ready(function ()
        {
            /* Bannert Position Save*/
            $("body").on('click', '.bgSave', function ()
            {

                var id = $(this).attr("id");
                var catid = $(this).attr("data-catid");
                var p = $("#timelineBGload" + catid).attr("style");

                var Y = p.split("top:");
                var Z = Y[1].split(";");

                var dataString = 'saveimageposition=saveimageposition&position=' + Z[0] + '&catid=' + $("#hid_catid" + catid).val();
                ;
                $.ajax({
                    type: "POST",
                    url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                    data: dataString,
                    cache: false,
                    beforeSend: function () {
                    },
                    success: function (html)
                    {
                        if (html)
                        {
                            $("#change-profile-pic" + catid).show();
                            $("#bgImage" + catid).fadeOut('slow');
                            $(".bgSave" + catid).fadeOut('slow');
                            $(".timelineShade" + catid).fadeIn("slow");
                            $("#timelineBGload" + catid).removeClass("headerimage");
                            $("#timelineBGload" + catid).css({'margin-top': html});
                            return false;
                        }
                    }
                });
                return false;
            });



        });
    </script>

    <script>
        function showembedcode() {
            $("#model_embedcode").modal("show");
        }

        /*Profile Image Upload Function*/
        function ProfileImage1(catid)
        {
            var img = $('#hid_profileImage1_' + catid).val();
            //var catid = $('#hid_profileImage1').attr("data-catid");
            var spltImg = img.split(".");
            if (spltImg[1] == 'jpg' || spltImg[1] == 'jpeg' || spltImg[1] == 'png' || spltImg[1] == 'JPG' || spltImg[1] == 'JPEG' || spltImg[1] == 'PNG')
            {
                var options = {
                    beforeSubmit: showRequestProfileImage1,
                    success: showResponseProfileImage1,
                    url: site_url + 'controllers/ajax_controller/preview-ajax-controller.php',
                    type: "POST"
                };
                $('#form_profileimage1_' + catid).submit(function () {
                    $(this).ajaxSubmit(options);
                    return false;
                });
                $('#form_profileimage1_' + catid).submit();
            } else
            {

                alert('Please select valid image file.');
            }
        }
        function showRequestProfileImage1(formData, jqForm, options) {
            return true;

        }
        function showResponseProfileImage1(data, statusText) {
            if (statusText == 'success'){
                if (data != '0') {
                    var data = data.split('|x|');
                    $("#profile_picture_"+data[0]).attr('src', data[1]);
                    return false;
                } else {
                    alert('Please upload image minimum size(100*100)');
                }
            }

            $('#form_profileimage1_' + data[0]).unbind();
            $('#form_profileimage1_' + data[0]).bind();
            //return false;
        }


        /*Profile Image Upload Function*/
        function ProfileImage(cat) {
            var img = $('#hid_profileImage' + cat).val();
            alert(img);
            var spltImg = img.split(".");
            if (spltImg[1] == 'jpg' || spltImg[1] == 'jpeg' || spltImg[1] == 'png' || spltImg[1] == 'JPG' || spltImg[1] == 'JPEG' || spltImg[1] == 'PNG')
            {
                var options = {
                    beforeSubmit: showRequestProfileImage,
                    success: showResponseProfileImage,
                    url: site_url + 'controllers/ajax_controller/preview-ajax-controller.php',
                    type: "POST"
                };
                $('#form_profileimage').submit(function () {
                    $(this).ajaxSubmit(options);
                    return false;
                });
                $('#form_profileimage').submit();
            } else
            {

                alert('Please select valid image file.');
            }
        }
        function showRequestProfileImage(formData, jqForm, options) {
            return true;

        }
        function showResponseProfileImage(data, statusText) {


            if (statusText == 'success')
            {

                if (data != '0') {
                    $("#timelineBackground").html(data);
                    $("#timelineShade").hide();
                    $("#bgimageform").hide();
                } else {
                    alert('Please upload image minimum size(100*100)');
                }
            }
            $('#form_profileimage').unbind();
            $('#form_profileimage').bind();
            return false;
        }

        /* Banner position drag */
        $("body").on('mouseover', '.headerimage', function ()
        {
            var y1 = $('#timelineBackground').height();
            var y2 = $('.headerimage').height();
            $(this).draggable({
                scroll: false,
                axis: "y",
                drag: function (event, ui) {
                    if (ui.position.top >= 0)
                    {
                        ui.position.top = 0;
                    } else if (ui.position.top <= y1 - y2)
                    {
                        ui.position.top = y1 - y2;
                    }
                },
                stop: function (event, ui)
                {
                }
            });
        });

        function starteditall() {
            $("#actiontoall").html('<button style="float:right" onClick="endeditall()" class="btn btn-primary">Finish Editing</button>');
            $("#toggle").trigger("click");
            $("#toggle_ft").trigger("click");
            $("#toggle_sb").trigger("click");

            $("#reset").remove();
            $("#reset_sb").remove();
            $("#reset_ft").remove();



        }

        function endeditall() {
            $("#actiontoall").html('<button style="float:right" onClick="starteditall()" class="btn btn-primary">Start Editing</button>');
            $("#toggle").trigger("click");
            $("#toggle_ft").trigger("click");
            $("#toggle_sb").trigger("click");
        }

        function settabajaxsidebar(catid) {

            $.ajax({
                url: site_url + 'controllers/ajax_controller/preview-save-sidebar-ajax-controller.php',
                type: 'post',
                data: 'setcattahbsidebar=1&catid=' + catid,
                success: function (result)
                {
                    $("#section_sidebarpart").html(result);
                    settabajaxfooter(catid);
                }
            });
        }
        function settabajaxfooter(catid) {
            $.ajax({
                url: site_url + 'controllers/ajax_controller/preview-save-footer-ajax-controller.php',
                type: 'post',
                data: 'setcattahbfooter=1&catid=' + catid,
                success: function (result)
                {
                    $("#introduction_ft").html(result);
                }
            });
        }

        function settabajax(catid) {

            $("#section_cat" + $("#hid_catid" + catid).val()).html("");
            $.ajax({
                url: site_url + 'controllers/ajax_controller/preview-save-header-ajax-controller.php',
                type: 'post',
                data: 'setcattahb=1&catid=' + catid,
                success: function (result)
                {
                    $("#section_cat" + catid).html(result);
                }
            });
        }

        $(function () {

            $("#sortablemusic").sortable();

<?php
if (!empty($previewcategories) && $previewcategories[0] != ''):
    foreach ($previewcategories as $key => $prvcat):
        $catdetail = $controller_class->getcategorydetailbyid($prvcat);
        ?>
                    $("#sortable<?php echo $catdetail['id']; ?>").sortable({
                        update: function (event, ui) {
                            setnewimageoreder("sortable<?php echo $catdetail['id']; ?>");
                        }
                    });
    <?php endforeach; ?>
                $("#sortable-hid").sortable({
                    disabled: true
                });
<?php endif; ?>
            //$( "div.preview-container, div.preview-item" ).disableSelection();
        });

        $(document).ready(function () {
            var keycall = '<?php echo $keycall ?>';
            if (keycall != '' && keycall > 0) {
                settabajaxsidebar(keycall);
            }

            initbasicevents();
        });

        function initbasicevents() {
            $(".remove-cross").unbind("click");
            $(".undo-cross").unbind("click");
            $(".remove-cross").click(function () {
                //moveitemtohiddentab(this);
                removeitemcatsubcat(this);
            });
            $(".undo-cross").click(function () {
                moveitembacktocategorytab(this);
            });
        }

        function setnewimageoreder(imggrup) {

            var eleary = [];
            var allitems = $("#" + imggrup).children().toArray();
            for (var i = 0; i < allitems.length; i++) {
                if ($(allitems[ i ]).data("tabval") != undefined) {
                    eleary.push($(allitems[ i ]).data("tabval") + "|" + $("#" + imggrup + " div.preview-item").index(allitems[ i ]));
                }
            }
            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                data: {setnewimageorederchk: "setnewimageorederchk", eleary: eleary}
            })
                    .done(function (data) {
                        //alert("change order ajax")
                        //alert(data);
                    });
        }

        function removeitemcatsubcat(curele) {

            var itmtorem = curele;
            var parentitm = $(itmtorem).parent();
            var tabval = $(parentitm).data("tabval");
            var gettab = $(parentitm).parent().attr("id");

            $(itmtorem).parent().remove();

            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                data: {makeuserimageremovecatsubcatchk: "makeuserimageremovecatsubcatchk", tabval: tabval}
            })
                    .done(function (data) {
                        if ($("div#" + gettab + " > div.preview-item").length <= 0) {
                            $("div#" + gettab).html('<div class="callout callout-info"><h4>No Image Found</h4><p><i class="fa fa-info-circle"></i> There is no image under this category to show.</p></div>');
                        }
                        if ($("div#sortable-hid > div.callout-info").length) {
                            $("div#sortable-hid > div.callout-info").remove();
                        }
                    });
        }

        function moveitemtohiddentab(curele) {

            var itmtorem = curele;
            var parentitm = $(itmtorem).parent();
            var tabval = $(parentitm).data("tabval");
            var gettab = $(parentitm).parent().attr("id");

            $(itmtorem).parent().remove();

            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                data: {makeuserimagehiddenchk: "makeuserimagehiddenchk", tabval: tabval}
            })
                    .done(function (data) {
                        //alert("tab to hidden");
                        if ($("div#" + gettab + " > div.preview-item").length <= 0) {
                            $("div#" + gettab).html('<div class="callout callout-info"><h4>No Image Found</h4><p><i class="fa fa-info-circle"></i> There is no image under this category to show.</p></div>');
                        }
                        if ($("div#sortable-hid > div.callout-info").length) {
                            $("div#sortable-hid > div.callout-info").remove();
                        }
                        $("div#sortable-hid").append(data);
                        $("#sortable-hid").sortable("refresh");
                        $("#" + gettab).sortable("refresh");
                        initbasicevents();
                        setnewimageoreder(gettab);
                        //alert(data);
                    });
        }
        function moveitembacktocategorytab(curele) {

            var itmtores = curele;
            var parentitm = $(itmtores).parent();
            var tabval = $(parentitm).data("tabval");
            var backto = $(parentitm).data("backto");

            $(itmtores).parent().remove();

            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                data: {moveitembacktocategorytabchk: "moveitembacktocategorytabchk", tabval: tabval}
            })
                    .done(function (data) {
                        //alert("back to tab");
                        if ($("div#" + backto + " > div.callout-info").length) {
                            $("div#" + backto + " > div.callout-info").remove();
                        }
                        if ($("div#sortable-hid > div.preview-item").length <= 0) {
                            $("div#sortable-hid").html('<div class="callout callout-info"><h4>No Image Found</h4><p><i class="fa fa-info-circle"></i> There is no hidden image to show.</p></div>');
                        }
                        $("#" + backto).append(data);
                        $("#sortable-hid").sortable("refresh");
                        $("#" + backto).sortable("refresh");

                        $('input').iCheck({
                            checkboxClass: 'icheckbox_minimal',
                            radioClass: 'iradio_minimal'
                        });

                        initbasicevents();
                        setnewimageoreder(backto);
                        //alert(data);
                    });
        }
        function openaddsubcatpopup(asgcat) {
            $("#stbcatcat").val(asgcat);
        }
        function addnewsubcategory() {
            var subcattitle = $("#txt_subcat_title").val();
            var subcatcatid = $("#stbcatcat").val();

            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                data: {addnewsubcatchk: "addnewsubcatchk", subcattitle: subcattitle, subcatcatid: subcatcatid}
            })
                    .done(function (data) {
                        //alert("back to tab");
                        $('#frm_add_subcategory').trigger('reset');
                        $.fancybox.close();
                        var sdata = $.trim(data)
                        var licnt = '<li id = "subtabli' + sdata + '"><a data-toggle="tab" href="#prvsubtab" onclick="loadsubcatimages(\'' + sdata + '\', \'' + subcatcatid + '\')">' + subcattitle + ' &nbsp;&nbsp;&nbsp; <i class="fa fa-times curs-pointer fancybox" href="#inline-pop-dlt-subcat" aria-hidden="true" onclick="opendltsubcatpopup(\'' + sdata + '\', \'' + subcatcatid + '\')"></i> </a>  </li>';

                        $("#subtabli-all-" + subcatcatid).before(licnt);

                        $("ul.subtabul" + subcatcatid + " li:first-child > a").click();

                    });

            return false;
        }
        function opendltsubcatpopup(asgcat, prtcat) {
            $("#dltstbcatcat").val(asgcat);
            $("#prtcategory").val(prtcat);
        }
        function dltnewsubcategory() {
            var dltstbcatcat = $("#dltstbcatcat").val();
            var prtcategory = $("#prtcategory").val();

            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                data: {dltnewsubcatchk: "dltnewsubcatchk", dltstbcatcat: dltstbcatcat}
            })
                    .done(function (data) {
                        //alert("back to tab");
                        $.fancybox.close();

                        $("#subtabli" + dltstbcatcat).remove();
                        $("ul.subtabul" + prtcategory + " li:first-child > a").click();
                    });

            return false;
        }
        function loadsubcatimages(subcat, cat) {

            $("#removesubcatimgcnfatag_subcati").val(subcat);

            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                data: {loadsubcatimageschk: "loadsubcatimageschk", subcat: subcat, cat: cat}
            })
                    .done(function (data) {
                        //alert("back to tab");
                        $("#sortable" + cat).html(data);
                        $("#sortable" + cat).sortable("refresh");

                        $("#sortable input:checked").prop('checked', false);
                        $('input').iCheck({
                            checkboxClass: 'icheckbox_minimal',
                            radioClass: 'iradio_minimal'
                        });

                        initbasicevents();
                    });

            return false;
        }

        function getallvisiblechkbox(selbox) {

            var chklist = '';
            $('#sortable input:checked').each(function () {

                if (chklist != '') {
                    chklist += ',';
                }

                // If input is visible and checked...
                if ($(this).is(':visible') && $(this).prop('checked') && $(this).val() != 'on') {

                    chklist += $(this).val();

                }

            });
            var selaction = $(selbox).val();
            if (chklist != '' && selaction != '') {

                var selcatid = $(selbox).data("selcatdata");

                if (selaction == 'remove') {
                    //alert('removesubcatimgcnfatag');

                    $("#removesubcatimgcnfatag_chklist").val(chklist);
                    $("#removesubcatimgcnfatag_catdata").val(selcatid);
                    $("#removesubcatimgcnfatag_bulkact").val(selaction);

                    $("#removesubcatimgcnfatag").click();

                } else {
                    $.ajax({
                        method: "POST",
                        url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                        data: {getsubcatoptionlistchk: "getsubcatoptionlistchk", selcatid: selcatid}
                    })
                            .done(function (data) {
                                //alert(data);
                                //alert("back to tab");
                                $("#bulkactcnfatag_lab").html("Select sub category to " + selaction);
                                $("#bulkactcnfatag_btn").html(selaction);
                                $("#bulkactcnfatag_sel").html(data);

                                $("#bulkactcnfatag_chklist").val(chklist);
                                $("#bulkactcnfatag_catdata").val(selcatid);
                                $("#bulkactcnfatag_bulkact").val(selaction);

                                $("#bulkactcnfatag").click();
                            });
                }
            }

            $("#sortable input:checked").prop('checked', false);
            $('input').iCheck({
                checkboxClass: 'icheckbox_minimal',
                radioClass: 'iradio_minimal'
            });
            $(selbox).val("");
        }
        function proccatbulkaction() {
            var chklist = $("#bulkactcnfatag_chklist").val();
            var catdata = $("#bulkactcnfatag_catdata").val();
            var subcati = $("#bulkactcnfatag_sel").val();
            var bulkact = $("#bulkactcnfatag_bulkact").val();

            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                data: {proccatbulkactionchk: "proccatbulkactionchk", chklist: chklist, catdata: catdata, subcati: subcati, bulkact: bulkact}
            })
                    .done(function (data) {
                        //alert(data);
                        $.fancybox.close();
                        $("ul.subtabul" + catdata + " li:first-child > a").click();
                    });

            return false;
        }

        function procrmvimgfrmsubcat() {
            var chklist = $("#removesubcatimgcnfatag_chklist").val();
            var catdata = $("#removesubcatimgcnfatag_catdata").val();
            var subcati = $("#removesubcatimgcnfatag_subcati").val();
            var bulkact = $("#removesubcatimgcnfatag_bulkact").val();

            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/preview-ajax-controller.php",
                data: {procrmvimgfrmsubcatchk: "procrmvimgfrmsubcatchk", chklist: chklist, catdata: catdata, subcati: subcati, bulkact: bulkact}
            })
                    .done(function (data) {
                        //alert(data);
                        $.fancybox.close();
                        $("ul.subtabul" + catdata + " li:first-child > a").click();
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
                        //alert(data);
                        $("#usrimgpopcntrow").html(data);

                        $.fancybox({
                            href: '#inline-pop-usr-img'
                        });

                        //$(".img-to-zoom").zoom({on: 'click'});
                    });
            return false;

        }
    </script>


    <script>
        $(document).ready(function () {
            // Sample: Inline Editing Enabled by Code
            (function () {
                var isEditingEnabled_FT,
                        toggle_ft = document.getElementById('toggle_ft'),
                        reset_ft = document.getElementById('reset_ft'),
                        introduction_ft = document.getElementById('introduction_ft'),
                        introduction_ftHTML = introduction_ft.innerHTML;

                function enable_ftEditing() {
                    if (!CKEDITOR.instances.introduction_ft) {
                        CKEDITOR.inline('introduction_ft', {
                            extraPlugins: 'uploadimage,image2',
                            height: 300,
                            uploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                            filebrowserBrowseUrl: '/projectone/ckfinder/ckfinder.html',
                            filebrowserImageBrowseUrl: '/projectone/ckfinder/ckfinder.html?type=Images',
                            filebrowserUploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                            filebrowserImageUploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                            stylesSet: [
                                {name: 'Narrow image', type: 'widget', widget: 'image', attributes: {'class': 'image-narrow'}},
                                {name: 'Wide image', type: 'widget', widget: 'image', attributes: {'class': 'image-wide'}}
                            ],
                            // Load the default contents.css file plus customizations for this sample.
                            contentsCss: [CKEDITOR.basePath + 'contents.css', 'https://sdk.ckeditor.com/samples/assets/css/widgetstyles.css'],
                            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
                            // resizer (because image size is controlled by widget styles or the image takes maximum
                            // 100% of the editor width).
                            image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
                            image2_disableResizer: true
                        });
                    }
                }

                function disable_ftEditing() {
                    if (CKEDITOR.instances.introduction_ft)
                        CKEDITOR.instances.introduction_ft.destroy();
                }

                function toggle_ftEditor() {
                    if (isEditingEnabled_FT) {
                        if (CKEDITOR.instances.introduction_ft && CKEDITOR.instances.introduction_ft.checkDirty()) {
                            //reset_ft.style.display = 'inline';
                        }
                        disable_ftEditing();
                        introduction_ft.setAttribute('contenteditable', false);
                        this.innerHTML = 'Start editing';
                        isEditingEnabled_FT = false;
                        save_ftContent(introduction_ft.innerHTML);
                    } else {
                        introduction_ft.setAttribute('contenteditable', true);
                        enable_ftEditing();
                        this.innerHTML = 'Finish editing';
                        isEditingEnabled_FT = true;
                    }
                }

                function reset_ftContent() {
                    reset_ft.style.display = 'none';
                    introduction_ft.innerHTML = introduction_ftHTML;
                    save_ftContent(introduction_ft.innerHTML);
                }

                function onClick_ft(element, callback) {
                    if (window.addEventListener) {
                        element.addEventListener('click', callback, false);
                    } else if (window.attachEvent) {
                        element.attachEvent('onclick', callback);
                    }
                }

                function save_ftContent(htmlcontent) {
                    var cat = $("#hid_catidsidebar").val();

                    $.post(site_url + 'controllers/ajax_controller/preview-save-footer-ajax-controller.php',
                            {content: htmlcontent, catid: cat}).done(function (data) {
                        console.log("Saved Successfully.");
                    });
                }

                onClick_ft(toggle_ft, toggle_ftEditor);
                onClick_ft(reset_ft, reset_ftContent);

            })();


        });


    </script> 
    <?php if (isset($_GET['workid']) && $_GET['workid'] != '') { ?>
        <script type="text/javascript">

            $(document).ready(function () {



                var tobeselected = '<?php echo $_GET["workid"]; ?>';
                console.log(tobeselected);
                $("a[href=#prvtab" + tobeselected + "]").click();
                $('.radiohostplay').click(function () {
                    var url = window.location.href;
                    var url = url.slice(2, url.lastIndexOf('/'));
                    var id = $(this).attr('id');
                    //alert(id);

                    window.location.href = "<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>preview/" + id;

                })
            })

        </script>
    <?php } ?>


    <script type="text/javascript">

        function placeTestLinks() {

            var hw = jQuery(".menu").width();

            var lnum = Math.floor((hw - (jQuery(".more").width() + 50 + 20)) / 70) - 2;


            jQuery(".test-links").append(jQuery(".links-hidden li"));

            if (lnum < 0 || hw < 320) {
                jQuery(".links-hidden").append(jQuery(".test-links li"));
                return;
            }


            jQuery(".links-hidden").append(jQuery(".test-links li:gt(" + lnum + ")"));


            jQuery(".test-links").show();
            if (jQuery(".links-hidden li").length == 0) {
                jQuery(".more").hide()
            } else {
                jQuery(".more").show()
            }
        }

        jQuery(".more > span").on("click", function () {
            jQuery(".links-hidden").toggle()
        });

        jQuery(document).ready(function () {
            placeTestLinks();
        });
        var resizeId;
        jQuery(window).resize(function () {
            clearTimeout(resizeId);
            resizeId = setTimeout(placeTestLinks, 100);
        });

    </script>

    <style type="text/css">
        .hide {display: none!important;}
        .links-outer { border-bottom:1px solid #ddd; float: left;width: 100%; }
        .test-links { float:left; border-bottom:0; }
        .hidden-xs {display:none;}
        .menu .links-hidden {background:#fff;border: 1px solid #ddd;z-index: 90;position: absolute;right: 0; top: 28px;width:135px;display: none;}
        .menu .links-hidden li {width: 100%;border-bottom:1px solid #ddd;}
        .menu .links-hidden li a {padding: 8px 10px;}
        .menu .links>a,.menu .links>span {width: 70px;display: inline-block;text-align: center;}
        .menu .more { float: left;margin-top: 13px;position:relative;margin-left: 5px;}
        .more span {cursor: pointer;color: #1eaedb;}
        .menu .more .links-hidden>a,.menu .more>u {display: inline-block;line-height: 35px;width: 100%;padding: 5px 0;}        

        @media (min-width: 1170px) {
            .show-xs {display: none;}
            .hidden-xs {display: inline-block;}
        }

    </style>

</body> 