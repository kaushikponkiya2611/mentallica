<?php

@session_start();
error_reporting(0);
include('../../models/db.php');
include('../../models/common-model.php');
include('../../includes/thumb_new.php');
include('../../includes/resize-class.php');
include('../../paypal/adaptive-payments.php');
include('../../paypal/config.php');
include('../common-controller.php');
$database = new Connection();
include('../../models/ajax-model.php');
$modelObj = new AjaxModel();
$commoncont = new CommonController();
$path = $_SERVER['DOCUMENT_ROOT'] . "/projectone/upload/art/";
$upload_dirthumb = $_SERVER['DOCUMENT_ROOT'] . "/projectone/upload/art/thumb/";
session_start();
$session_uid = '1'; // $_SESSION['user_id'];
$uid = $_SESSION['po_userses']['flc_usrlogin_id'];
if ((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist'] != '')) {
    $uid = $_SESSION['current_artist'];
}
if (isset($_POST['uploadImage1']) && $_POST['uploadImage1'] != ''):
    $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
    if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_FILES['hid_profileImage1']['name'];
        $size = $_FILES['hid_profileImage1']['size'];
        if (!dir($upload_dirthumb)) {
            mkdir($upload_dirthumb);
        }
        if (strlen($name)) {
            $ext = $commoncont->getExtension($name);

            if (in_array($ext, $valid_formats)) {

                if ($size < 5000000) {

                    $actual_image_name = time() . $session_uid . "." . $ext;
                    $tmp = $_FILES['hid_profileImage1']['tmp_name'];

                    if (move_uploaded_file($tmp, $path . $actual_image_name)) {

                        $data = $commoncont->userBackgroundUpdate($uid, $actual_image_name, $_POST['hid_catid']);
                        if ($data)
                            $resizeObj_20 = new resize($path . $actual_image_name);
                        $resizeObj_20->resizeImage(200, 200, 'crop');
                        $resizeObj_20->saveImage($upload_dirthumb . $actual_image_name, $path . $actual_image_name, 100);
                        echo $_POST['hid_catid'] . "|x|" . $_SESSION['FRNT_DOMAIN_NAME'] . 'upload/art/thumb/' . $actual_image_name;
                    }
                    else {
                        echo "Fail upload folder with read access.";
                    }
                } else
                    echo "Image file size max 1 MB";
            } else
                echo "Invalid file format.";
        } else
            echo "Please select image..!";
        ?>

        <?php

        exit;
    }
endif;
if (isset($_POST['saveimageposition']) && $_POST['saveimageposition'] != ''):
    $position = $_POST['position'];
    $data = $commoncont->userBackgroundPositionUpdate($uid, $position, $_POST['catid']);
    if ($data)
        echo $position;
endif;
if (isset($_POST['uploadImage']) && $_POST['uploadImage'] != ''):
    $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
    if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($session_uid)) {
        $name = $_FILES['hid_profileImage2']['name'];
        $size = $_FILES['hid_profileImage2']['size'];
        if (strlen($name)) {
            $ext = $commoncont->getExtension($name);
            if (in_array($ext, $valid_formats)) {
                if ($size < (1024 * 1024)) {
                    $actual_image_name = time() . $session_uid . "." . $ext;
                    $tmp = $_FILES['hid_profileImage2']['tmp_name'];
                    $bgSave = '<div id="uX' . $session_uid . '" class="bgSave wallbutton blackButton">Save Cover</div>';
                    if (move_uploaded_file($tmp, $path . $actual_image_name)) {

                        $data = $commoncont->userBackgroundUpdate($uid, $actual_image_name, $_POST['hid_catid']);
                        if ($data)
                            echo $bgSave . '<img  src="' . $_SESSION['SITE_NAME'] . 'upload/art/' . $actual_image_name . '"  id="timelineBGload" class="headerimage ui-corner-all" style="top:0px"/>';
                    }
                    else {
                        echo "Fail upload folder with read access.";
                    }
                } else
                    echo "Image file size max 1 MB";
            } else
                echo "Invalid file format.";
        } else
            echo "Please select image..!";

        exit;
    }
endif;
if (isset($_POST['setnewimageorederchk']) && $_POST['setnewimageorederchk'] != ''):
    $imgpos = $_POST['eleary'];
    foreach ($imgpos as $key => $impo) {
        $impodata = explode("|", $impo);
        $qry = "UPDATE tbl_user_images SET image_rank = '" . clear_input($impodata[1]) . "' WHERE id='" . clear_input($impodata[0]) . "' ";
        $result = $modelObj->runQuery($qry);
    }
    echo 1;
    exit;
endif;

if (isset($_POST['makeuserimageremovecatsubcatchk']) && $_POST['makeuserimageremovecatsubcatchk'] != ''):
    $tabval = $_POST['tabval'];

    $qry = "UPDATE tbl_user_images SET category_id = 0   WHERE id='" . clear_input($tabval) . "' ";
    $result = $modelObj->runQuery($qry);

    $qry1 = "UPDATE tbl_users_sub_category_images SET cat_id = 0, subcat_id = 0   WHERE userimage_id='" . clear_input($tabval) . "' ";
    $result1 = $modelObj->runQuery($qry1);
    exit;
endif;


if (isset($_POST['makeuserimagehiddenchk']) && $_POST['makeuserimagehiddenchk'] != ''):
    $tabval = $_POST['tabval'];
    $qry = "UPDATE tbl_user_images SET status = 0 WHERE id='" . clear_input($tabval) . "' ";
    $result = $modelObj->runQuery($qry);
    $userimgdetail = $commoncont->getuserimagedetailbyid($tabval);
    //print_r($userimgdetail);
    $itemhtml = '<div class="col-lg-3 col-md-3 col-xs-6 preview-item ui-state-default" style="min-height:225px;background-image: url(\'' . $_SESSION['SITE_NAME'] . 'upload/images/300/' . $userimgdetail['image'] . '\');background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" data-backto="sortable' . $userimgdetail['category_id'] . '" data-tabval="' . $userimgdetail['id'] . '">
          <i class="fa fa-undo undo-cross" title="Restore image"></i>
          <a href="javascript:void(0)" onclick="openuserimageinpopup(\'' . $userimgdetail['id'] . '\')" class="openpop-link">&nbsp;</a>
          <!--<a>
              <img src="' . $_SESSION['SITE_NAME'] . 'upload/images/300/' . $userimgdetail['image'] . '" alt="..." class="example-image img-responsive" />
          </a>

          <h3>
              ' . $userimgdetail['img_title'] . '
          </h3>  -->  

      </div>';
    echo $itemhtml;
    exit;
endif;
if (isset($_POST['moveitembacktocategorytabchk']) && $_POST['moveitembacktocategorytabchk'] != ''):
    $tabval = $_POST['tabval'];

    $qry = "UPDATE tbl_user_images SET status = 1 WHERE id='" . clear_input($tabval) . "' ";
    $result = $modelObj->runQuery($qry);

    $userimgdetail = $commoncont->getuserimagedetailbyid($tabval);
    //print_r($userimgdetail);
    $itemhtml = '<div class="col-lg-3 col-md-3 col-xs-6 preview-item ui-state-default" style="min-height: 225px; background-image: url(\'' . $_SESSION['SITE_NAME'] . 'upload/images/300/' . $userimgdetail['image'] . '\'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" data-tabval="' . $userimgdetail['id'] . '">
          <a href="' . $_SESSION['FRNT_DOMAIN_NAME'] . 'editimage/' . $userimgdetail['id'] . '"><i class="fa fa-pencil-square-o edit-icon" title="Edit image"></i></a>
          <i class="fa fa-times-circle remove-cross" title="Hide image"></i>
          <a href="javascript:void(0)" onclick="openuserimageinpopup(\'' . $userimgdetail['id'] . '\')" class="openpop-link">&nbsp;</a>
          <!--<a>
              <img src="' . $_SESSION['SITE_NAME'] . 'upload/images/300/' . $userimgdetail['image'] . '" alt="..." class="example-image img-responsive" />
          </a>
          <h3>
              ' . $userimgdetail['img_title'] . '
          </h3>  -->  
          <input type="checkbox" id="imgchk' . $userimgdetail['id'] . '" class="actionchk" title="Select" value="' . $userimgdetail['id'] . '" />
      </div>';
    echo $itemhtml;
    exit;
endif;
if (isset($_POST['addnewsubcatchk']) && $_POST['addnewsubcatchk'] != ''):
    $subcattitle = $_POST['subcattitle'];
    $subcatcatid = $_POST['subcatcatid'];

    $qry = "INSERT INTO tbl_users_sub_categories (`cat_id`, `user_id`, `sub_category_title`, `cr_date`, `status`) VALUES('" . clear_input($subcatcatid) . "', '" . clear_input($uid) . "', '" . clear_input($subcattitle) . "', NOW(), 1) ";
    $result = $modelObj->runQuery($qry);
    $lastinsertedid = mysql_insert_id();
    echo $lastinsertedid;
    exit;
endif;
if (isset($_POST['dltnewsubcatchk']) && $_POST['dltnewsubcatchk'] != ''):
    $dltstbcatcat = $_POST['dltstbcatcat'];

    $qry = "DELETE FROM tbl_users_sub_categories WHERE id = '" . clear_input($dltstbcatcat) . "' ";
    $result = $modelObj->runQuery($qry);

    if ($result) {
        $qry = "DELETE FROM tbl_users_sub_category_images WHERE subcat_id = '" . clear_input($dltstbcatcat) . "' ";
        $result = $modelObj->runQuery($qry);
    }

    echo 1;
    exit;
endif;
if (isset($_POST['loadsubcatimageschk']) && $_POST['loadsubcatimageschk'] != ''):
    $subcat = $_POST['subcat'];
    $cat = $_POST['cat'];

    $modcnt = 0;
    $itemhtml = '';
    $imglist = $commoncont->getimagesbySubcatCatUserid($uid, $cat, $subcat);
    if (!empty($imglist)):
        foreach ($imglist as $k => $imgsdata):

            $itemhtml .= '<div class="col-lg-3 col-md-3 col-xs-6 preview-item ui-state-default" style="min-height: 225px; background-image: url(\'' . $_SESSION['SITE_NAME'] . 'upload/images/300/' . $imgsdata['image'] . '\'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" data-tabval="' . $imgsdata['id'] . '">
                <a href="' . $_SESSION['FRNT_DOMAIN_NAME'] . 'editimage/' . $imgsdata['id'] . '"><i class="fa fa-pencil-square-o edit-icon" title="Edit image"></i></a>
                <i class="fa fa-times-circle remove-cross" title="Hide image"></i>
                <a href="javascript:void(0)" onclick="openuserimageinpopup(\'' . $imgsdata['id'] . '\')" class="openpop-link">&nbsp;</a>
                <!--<a>
                    <img src="' . $_SESSION['SITE_NAME'] . 'upload/images/300/' . $imgsdata['image'] . '" alt="..." class="example-image img-responsive" />
                </a>

                <h3>
                    ' . $imgsdata['img_title'] . '
                </h3>  -->  
                <!--<input type="checkbox" id="imgchk' . $imgsdata['id'] . '" class="actionchk" title="Select" value="' . $imgsdata['id'] . '" />-->
            </div>';
        endforeach;
    else:
        $itemhtml .= '<div class="callout callout-info">
            <h4>No Image Found</h4>
            <p><i class="fa fa-info-circle"></i> There is no image under this category to show.</p>            
        </div>';
    endif;
    echo $itemhtml;
    exit;
endif;
if (isset($_POST['getsubcatoptionlistchk']) && $_POST['getsubcatoptionlistchk'] != ''):

    $selcatid = $_POST['selcatid'];

    $subcatlist = $commoncont->getsubcategorylistbyusercatids($uid, $selcatid);
    $optionlist = '<option value="">Select Action</option>';
    foreach ($subcatlist as $key => $subcats) {
        $optionlist .= '<option value="' . $subcats['id'] . '">' . $subcats['sub_category_title'] . '</option>';
    }
    echo $optionlist;
    exit;
endif;
if (isset($_POST['proccatbulkactionchk']) && $_POST['proccatbulkactionchk'] != ''):

    $chklist = explode(",", $_POST['chklist']);
    $catdata = $_POST['catdata'];
    $subcati = $_POST['subcati'];
    $bulkact = $_POST['bulkact'];

    if ($chklist != '' && $catdata != '' && $subcati != '' && $bulkact != '') {
        foreach ($chklist as $key => $imgdata) {
            $chkifexist = $commoncont->checkifimageexistinsubcat($uid, $catdata, $subcati, $imgdata);

            if ($bulkact == 'move') {
                $commoncont->removeimagefromallsubcategory($uid, $catdata, $subcati, $imgdata);
                $commoncont->addimagetosubcategory($uid, $catdata, $subcati, $imgdata);
            } elseif ($bulkact == 'add' && $chkifexist == 0) {
                $commoncont->addimagetosubcategory($uid, $catdata, $subcati, $imgdata);
            }
        }
    }

    echo 1;
    exit;
endif;
if (isset($_POST['procrmvimgfrmsubcatchk']) && $_POST['procrmvimgfrmsubcatchk'] != ''):

    $chklist = explode(",", $_POST['chklist']);
    $catdata = $_POST['catdata'];
    $subcati = $_POST['subcati'];
    $bulkact = $_POST['bulkact'];

    if ($chklist != '' && $catdata != '' && $subcati != '' && $bulkact != '') {
        foreach ($chklist as $key => $imgdata) {
            $commoncont->removeimagefromsubcategory($uid, $catdata, $subcati, $imgdata);
        }
    }

    echo 1;
    exit;
endif;

if (isset($_POST['saveuserbid']) && $_POST['saveuserbid'] != '') {
    $qry = "UPDATE tbl_user_images SET user_bid = '" . $_POST['bidvalue'] . "' WHERE id='" . clear_input($_POST['usrimgid']) . "' ";
    $result = $modelObj->runQuery($qry);

    $qry1 = "SELECT user_id,img_title,category_id FROM tbl_user_images WHERE id='" . $_POST['usrimgid'] . "'";
    $result1 = $modelObj->fetchRows($qry1);
    if (!empty($result1)) {
        $userid = $result1[0]['user_id'];
        $img_title = $result1[0]['img_title'];
        $category_id = $result1[0]['category_id'];
        $name = $_SESSION['po_userses']['flc_usrlogin_first_nm'] . ' ' . $_SESSION['po_userses']['flc_usrlogin_last_nm'];
        $requesteduser = $uid;
        if (!empty($_SESSION['po_userses']['flc_usrlogin_first_nm'])) {
            $content = "Name : " . $_SESSION['po_userses']['flc_usrlogin_first_nm'] . ' ' . $_SESSION['po_userses']['flc_usrlogin_last_nm'] . '<br>';
            $content = "ImageID  : " . $_POST['usrimgid'] . '<br>';
            $content = "Bid Ammount  : " . $_POST['bidvalue'] . '<br>';

            $qry3 = "INSERT INTO tbl_notification (`userid`,`requesteduser`,`name` ,`objectid`, `objectcat`,`subject`,`message`, `price`, `status`,`type`,`cr_date`) VALUES('" . clear_input($userid) . "','" . $requesteduser . "','" . $name . "','" . $_POST['usrimgid'] . "','" . $category_id . "','" . $img_title . "', '" . $content . "', '" . $_POST['bidvalue'] . "',  '1','bid',NOW()) ";

            $result3 = $modelObj->runQuery($qry3);
        }
    }
}

if (isset($_POST['saveuserrent']) && $_POST['saveuserrent'] != '') {
    $qry = "UPDATE tbl_user_images SET rent_calendar = '" . $_POST['rentvalue'] . "' WHERE id='" . clear_input($_POST['usrimgid']) . "' ";
    $result = $modelObj->runQuery($qry);

    $qry1 = "SELECT user_id,img_title,category_id FROM tbl_user_images WHERE id='" . $_POST['usrimgid'] . "'";
    $result1 = $modelObj->fetchRows($qry1);
    if (!empty($result1)) {
        $userid = $result1[0]['user_id'];
        $img_title = $result1[0]['img_title'];
        $category_id = $result1[0]['category_id'];

        $name = $_SESSION['po_userses']['flc_usrlogin_first_nm'] . ' ' . $_SESSION['po_userses']['flc_usrlogin_last_nm'];
        $requesteduser = $uid;
        if (!empty($_SESSION['po_userses']['flc_usrlogin_first_nm'])) {
            $content = "Name : " . $_SESSION['po_userses']['flc_usrlogin_first_nm'] . ' ' . $_SESSION['po_userses']['flc_usrlogin_last_nm'] . '<br>';
            $content = "ImageID  : " . $_POST['usrimgid'] . '<br>';
            $content = "Rent from to  : " . $_POST['rentvalue'] . '<br>';

            $qry3 = "INSERT INTO tbl_notification (`userid`,`requesteduser`,`name` ,`objectid`, `objectcat`,`subject`,`message`, `price`, `status`,`type`,`cr_date`) VALUES('" . clear_input($userid) . "','" . $requesteduser . "','" . $name . "','" . $_POST['usrimgid'] . "','" . $category_id . "','" . $img_title . "', '" . $content . "', '" . $_POST['bidvalue'] . "',  '1','bid',NOW()) ";
            $result3 = $modelObj->runQuery($qry3);
        }
    }
}


if (isset($_POST['getuserimagedatachk']) && $_POST['getuserimagedatachk'] != ''):
    $isbid = '';
    $isrent = '';
    $addpaypalbutton = '';
    $usrimgid = $_POST['usrimgid'];

    $userimgdetail = $commoncont->getuserimagedetailbyid($usrimgid);
    $imgcurrency = $commoncont->getcurrencydetailbyid($userimgdetail['price_currency']);
    if ($userimgdetail['show_front'] == 1):
        if ($userimgdetail['is_sold'] == 1):
            $issold = '<button class="col-xs-3 margin-top-10 btn btn-danger btn_sold_img">SOLD</button> &nbsp; <div class="clearfix"></div>';
        else:
            $issold = '<button class="col-xs-4 margin-top-10 btn btn-success" >For Sale</button> &nbsp; <div class="clearfix"></div>';
        endif;
    endif;

    if ($userimgdetail['showprice_front'] == 1):
        $imgprice = '<button class="col-xs-3 margin-top-10 btn btn-warning" >' . $imgcurrency['cur_text'] . $userimgdetail['img_price'] . '</button> &nbsp;';
    endif;


    if ($userimgdetail['is_bid'] == 1):
        $isbid = '<div class="bidding-block">
      <button class="col-xs-3 margin-top-10 btn btn-success">Bid</button>
      <input type="text" class="bid-input" id="bidvalue" value="' . $userimgdetail['user_bid'] . '">	<button class=" btn btn-success" onClick="userbidsave(' . $userimgdetail['id'] . ')" >Save</button></div>';
    endif;
    if ($userimgdetail['is_rent'] == 1):
        $isrent = ' <div class="rent-datepicker">          
      <input type="text" name="daterange" id="rentvalue" value="' . $userimgdetail['rent_calendar'] . '" /><button class="col-xs-3 margin-top-10 btn btn-success" onClick="userrentsave(' . $userimgdetail['id'] . ')" >Save</button></div>';
    endif;


    //K - Paypal For Img
    if ($imgprice != '') {
        $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        //$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
        //$paypal_id = 'scampi-facilitator@mentallica.com';
        $paypal_id = 'scampi@mentallica.com';
        $paypal_id = 'kaushikponkiya-facilitator@outlook.com';
        $paypal_url = PAYPAL_URL;
        $paypal_id = PAYPAL_ID;
        $addpaypalbutton = "<form action='" . $paypal_url . "' method='post' name='frmPayPal1'>
            <input type='hidden' name='business' value='" . $paypal_id . "'>
            <input type='hidden' name='cmd' value='_xclick'>
            <input type='hidden' name='item_name' value='" . $userimgdetail['img_title'] . "'>
            <input type='hidden' name='item_number' value='" . $userimgdetail['id'] . "'>
            <input type='hidden' name='amount' value='" . $userimgdetail['img_price'] . "'>	 
            <input type='hidden' name='no_shipping' value='1'> 
            <input type='hidden' name='quantity' value='1'>
            <input name = 'rm' value = '2' type = 'hidden'>
                <input name = 'lc' value = 'US' type = 'hidden'>
            <input type='hidden' name='currency_code' value='USD'>
            <input type='hidden' name='handling' value='0'> 
            <input type='hidden' name='notify_url' value=" . $_SESSION['FRNT_DOMAIN_NAME'] . "success>
            <input type='hidden' name='cancel_return' value=" . $_SESSION['FRNT_DOMAIN_NAME'] . "cancel>
            <input type='hidden' name='return' value=" . $_SESSION['FRNT_DOMAIN_NAME'] . "success> 
            " . $imgprice . "
            </form>";
    }
    $_SESSION['itemDetailSession'] = $userimgdetail['id'];
    $_SESSION['itemPriceSession'] = $userimgdetail['img_price'];
    echo $usrimgpopcnt = '<div class="col-lg-8 col-md-8 col-xs-12">
              <div class=" col-xs-12" id="img-to-zoom-' . $userimgdetail['id'] . '"><a id="Zoom-1" class="MagicZoom" href=' . $_SESSION['SITE_NAME'] . 'upload/images/' . $userimgdetail['image'] . '><img class="example-image img-responsive" id="inline-pop-img-' . $userimgdetail['id'] . '-img" alt="..." src="' . $_SESSION['SITE_NAME'] . 'upload/images/' . $userimgdetail['image'] . '"/></a><!--<p>Click to zoom</p>--></div>
          </div>
          <div class="col-lg-4 col-md-4 col-xs-12 portfolio-item-details">
        <h3>
          ' . $userimgdetail['img_title'] . '
        </h3>
        <p>' . $userimgdetail['image_text'] . '</p>
        ' . $issold . '
        ' . $addpaypalbutton . '
        ' . $isbid . '
		' . $isrent . '
        
        <div style="clear:both;"></div>
      </div>';

    //echo 1;
    exit;
endif;



if (isset($_POST['getusermusicdatachk']) && $_POST['getusermusicdatachk'] != ''):

    $isbid = '';
    $isrent = '';
    $addimgprice = '';
    $dwnimgprice = '';
    $usrimgid = $_POST['usrimgid'];
    $userimgdetail = $commoncont->getuserimagedetailbyid($usrimgid);
    $imgcurrency = $commoncont->getcurrencydetailbyid($userimgdetail['price_currency']);
    /* echo '<pre>';
      print_r($userimgdetail); */

    if ($userimgdetail['is_sold'] == 1):
        $issold = '<button class="col-xs-12 margin-top-10 btn btn-danger btn_sold_img">SOLD</button> &nbsp;';
    else:
        $issold = '<button class="col-xs-12 margin-top-10 btn btn-success" >For Sale</button> &nbsp;';
    endif;


    if ($userimgdetail['show_front'] == 1):
        $addimgprice = '<button class="col-xs-12 margin-top-10 btn btn-success" >Add Music Price : ' . $imgcurrency['cur_text'] . $userimgdetail['img_price'] . '</button> &nbsp;';
    endif;
    if ($userimgdetail['showprice_front'] == 1):
        $dwnimgprice = '<button class="col-xs-12 margin-top-10 btn btn-warning" >Dowanload Music Price : ' . $imgcurrency['cur_text'] . $userimgdetail['dowanload_price'] . '</button> &nbsp;';
    endif;
    if ($userimgdetail['is_bid'] == 1):
        $isbid = '<div class="bidding-block">
          <button class="col-xs-3 margin-top-10 btn btn-success">Bid</button>
          <input type="text" class="bid-input" id="bidvalue" value="' . $userimgdetail['user_bid'] . '">	<button class=" btn btn-success" onClick="userbidsave(' . $userimgdetail['id'] . ')" >Save</button></div>';
    endif;
    if ($userimgdetail['is_rent'] == 1):
        $isrent = ' <div class="rent-datepicker">          
          <input type="text" name="daterange" id="rentvalue" value="' . $userimgdetail['rent_calendar'] . '" /><button class="col-xs-3 margin-top-10 btn btn-success" onClick="userrentsave(' . $userimgdetail['id'] . ')" >Save</button></div>';
    endif;

    // $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    //$paypal_id = 'scampi-facilitator@mentallica.com';
    // $paypal_id = 'kaushikponkiya-facilitator@outlook.com';
    //$paypal_id = 'sriniv_1293527277_biz@inbox.com';
    //$paypal_id='dharmesh1809@gmail.com';
    $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
    //$paypal_id = 'scampi-facilitator@mentallica.com';
    $paypal_id = 'scampi@mentallica.com';
    $userdwncntadd = $commoncont->checkpaymentusermusic($_SESSION['po_artistid'], $usrimgid, '1');
    $dwnuserdwncntadd = $commoncont->checkpaymentusermusic($_SESSION['po_artistid'], $usrimgid, '2');

    if ($userimgdetail['img_price'] == '0.00' && $userdwncntadd > 0) {
        $addpaypalbutton = "<form action='" . $_SESSION['FRNT_DOMAIN_NAME'] . "'paypal/success.php' method='post' name='frmPayPal1'>
				
				<input type='hidden' name='cmd' value='_xclick'>
				<input type='hidden' name='item_name' value='" . $userimgdetail['img_title'] . "'>
				<input type='hidden' name='item_number' value='" . $userimgdetail['id'] . "'>
				<input type='hidden' name='amount' value='0.00'>	 
				<input type='hidden' name='amt' value='0.00'>	 
				<input type='hidden' name='no_shipping' value='1'> 
				<input type='hidden' name='currency_code' value='USD'>
				<input type='hidden' name='handling' value='0'>
				<input type='hidden' name='payment_type' value='1'> 
				<input type='submit' name='submit' value='Add Music' class='col-xs-12 margin-top-10 btn btn-success'>
				</form>";
    } else {
        $addpaypalbutton = "<form action='" . $paypal_url . "' method='post' name='frmPayPal1'>
        <input type='hidden' name='business' value='" . $paypal_id . "'>
        <input type='hidden' name='cmd' value='_xclick'>
        <input type='hidden' name='item_name' value='" . $userimgdetail['img_title'] . "'>
        <input type='hidden' name='item_number' value='" . $userimgdetail['id'] . "'>
        <input type='hidden' name='amount' value='" . $userimgdetail['img_price'] . "'>	 
        <input type='hidden' name='no_shipping' value='1'> 
        <input type='hidden' name='currency_code' value='USD'>
        <input type='hidden' name='handling' value='0'> 
        <input type='hidden' name='cancel_return' value=" . $_SESSION['FRNT_DOMAIN_NAME'] . "cancel>
        <input type='hidden' name='return' value=" . $_SESSION['FRNT_DOMAIN_NAME'] . "paypal/success.php> 
        " . $addimgprice . "
        </form>";
    }

    if ($userimgdetail['dowanload_price'] == '0.00' && $dwnuserdwncntadd > 0) {
        $dwnpaypalbutton = "<form action='" . $_SESSION['FRNT_DOMAIN_NAME'] . "paypal/success.php' method='post' name='frmPayPal1'>
                <input type='hidden' name='cmd' value='_xclick'>
                <input type='hidden' name='item_name' value='" . $userimgdetail['img_title'] . "'>
                <input type='hidden' name='item_number' value='" . $userimgdetail['id'] . "'>
                <input type='hidden' name='amount' value='0.00'>	 
                <input type='hidden' name='amt' value='0.00'>	 
                <input type='hidden' name='no_shipping' value='1'> 
                <input type='hidden' name='currency_code' value='USD'>
                <input type='hidden' name='handling' value='0'>
                <input type='hidden' name='payment_type' value='2'> 
                <input type='submit' name='submit' value='Dowanload Music' class='col-xs-12 margin-top-10 btn btn-warning'>
            </form>";
    } else {
        $dwnpaypalbutton = "<form action='" . $paypal_url . "' method='post' name='frmPayPal1'>
				<input type='hidden' name='business' value='" . $paypal_id . "'>
				<input type='hidden' name='cmd' value='_xclick'>
				<input type='hidden' name='item_name' value='" . $userimgdetail['img_title'] . "'>
				<input type='hidden' name='item_number' value='" . $userimgdetail['id'] . "'>
				<input type='hidden' name='amount' value='" . $userimgdetail['dowanload_price'] . "'> 
				<input type='hidden' name='no_shipping' value='1'>
				<input type='hidden' name='currency_code' value='USD'> 
				<input type='hidden' name='handling' value='0'> 
				<input type='hidden' name='cancel_return' value=" . $_SESSION['FRNT_DOMAIN_NAME'] . "cancel>
				<input type='hidden' name='return' value=" . $_SESSION['FRNT_DOMAIN_NAME'] . "success.php>" . $dwnimgprice . "
			</form>";
    }
    $mArg = explode('/', $userimgdetail['music']);

    $artLink = '';
    if ($userimgdetail['music_link'] != '') {
        //echo "<a target='_new' href='" . $_SESSION['FRNT_DOMAIN_NAME'] . "musicartistpreview/".$userimgdetail['id']."'>Music Artist</a>";
        $artLink = $userimgdetail['music_link'];
    } else {
        $userD = $commoncont->getuserdetailfromuserid($userimgdetail['music_artist']);
        $artLink = $_SESSION['FRNT_DOMAIN_NAME'] . "musicartistpreview/" . $userimgdetail['id'];
        // echo "<a target='_new'  href='" . $_SESSION['FRNT_DOMAIN_NAME'] . "musicartistpreview/".$userimgdetail['id']."'>" . $userD['first_name'] . " " . $userD['last_name'] . "</a>";
    }

    //die;
    echo $usrimgpopcnt = '<div class="col-lg-8 col-md-8 col-xs-12">
            <div class=" col-xs-12" id="img-to-zoom-' . $userimgdetail['id'] . '"><a href="' . $artLink . '"><img class="example-image img-responsive" id="inline-pop-img-' . $userimgdetail['id'] . '-img" alt="..." src="' . $_SESSION['SITE_NAME'] . 'upload/images/' . $userimgdetail['image'] . '"></a><!--<p>Click to zoom</p>--><div style="clear:both;"></div><br/>
                <div id="aPlayer">
                <audio src="' . $_SESSION['FRNT_DOMAIN_NAME'] . 'upload/images/' . end($mArg) . '" controls autoplay></audio></div></div> 
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 portfolio-item-details">
        <h3>
          ' . $userimgdetail['img_title'] . '
        </h3>
        <p>' . $userimgdetail['image_text'] . '</p>
        ' . $addpaypalbutton . '
        ' . $dwnpaypalbutton . '
        ' . $isbid . '
		' . $isrent . '
        <div style="clear:both;"></div><br/>
      </div>';
    exit;
endif;



//Wallet
if (isset($_POST['userWallet']) && $_POST['userWallet'] != '') {
    $amount = $_POST['amount'];
    $qry3 = "INSERT INTO  tbl_wallet_payout_request (`user_id`,`amount` ,`request_status`) VALUES('" . clear_input($uid) . "','" . $amount . "','pending') ";
    $result3 = $modelObj->runQuery($qry3);
    echo "<h3>Payout request sent!</h3>";
    die;
}
?>
