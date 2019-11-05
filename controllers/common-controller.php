
<?php

class CommonController {

    function __construct() {
        $this->modelObj = new CommonModel();
        if (isset($_GET['pid']) && $_GET['pid'] != '') {
            $_SESSION['pid'] = $_GET['pid'];
        }
        $this->seodata = $this->getPagetTitleAndHeading();
        
        $array = explode('@', $this->seodata);
        $this->pageTitle = $array[0];
        $this->h1 = $array[1];
        $this->mainimage = $array[2];
        //echo $_SESSION['pid'];exit;
        //echo $_SESSION['po_userses']['flc_usrlogin_id'];
        if ($_GET['pid'] == '' OR $_GET['pid'] == 'home' OR $_GET['pid'] == 'homenew') {
            $this->homecategorylist = $this->getcategorylist();
            $this->homeadvertiselist = $this->getadvertiselist();
            $this->homevideo = $this->getHomeVideo();
            $this->homesponserlist = $this->homesponserlists();
        }

        if (isset($_GET['acticod']) && $_GET['acticod'] != '' && $_GET['pid'] == 'login'):
            $this->getactusr = $this->getuserdetailbyrefid(base64_decode($_GET['acticod']));
           
            session_destroy();
            unset($_SESSION['po_userses']);
            session_start();
            
            if ($this->getactusr['status'] == '2'):
                $_SESSION['loginActivate'] = "activate";
                $_SESSION['po_userses']['login_error'] = '<h4>No user found</h4><p>No user found to activate account.</p>';
                $_SESSION['po_userses']['login_error_cls'] = "callout-danger";
                //header("Location: " . $_SESSION['FRNT_DOMAIN_NAME'] . "login/");
                //exit;
            elseif ($this->getactusr['status'] == '1'):
                $_SESSION['loginActivate'] = "activate";
                $_SESSION['po_userses']['login_error'] = '<h4>Already activated</h4><p>Your account is already activated, login to access your account.</p>';
                $_SESSION['po_userses']['login_error_cls'] = "callout-danger";
                //header("Location: " . $_SESSION['FRNT_DOMAIN_NAME'] . "login/");
                //exit;
            else:
                $this->activatereguser($this->getactusr['id']);
                $_SESSION['loginActivate'] = "activate";
                $_SESSION['po_userses']['login_error'] = '<h4>Activated successfully</h4><p>Your account is successfully activated, login to access your account.</p>';
                $_SESSION['po_userses']['login_error_cls'] = "callout-info";
                
            endif;
            $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https';
            $location = $protocol . "://" .$_SERVER['HTTP_HOST'] . "/projectone/";
            header("Location: " . $location );
            exit;
        endif;

        /* if((!isset($_SESSION['po_userses']['flc_usrlogin_id']) || $_SESSION['po_userses']['flc_usrlogin_id'] == '') && (($_SESSION['pid'] != 'login' && $_SESSION['pid'] != 'register' && $_SESSION['pid'] != 'plans' && $_SESSION['pid'] != 'payment' && $_SESSION['pid'] != 'forgotpassword') || $_GET['pid'] == '')){
          $this -> redirecttologinpage();
          }elseif((isset($_SESSION['po_userses']['flc_usrlogin_id']) || $_SESSION['po_userses']['flc_usrlogin_id'] != '') && ($_SESSION['pid'] == 'login' || $_SESSION['pid'] == 'register' && $_SESSION['pid'] != 'plans' && $_SESSION['pid'] != 'payment' && $_SESSION['pid'] != 'forgotpassword')){
          $this -> redirecttohomepage();
          } */

        /* Restrict Artist Pages */
        if ((isset($_SESSION['po_userses']['flc_usrlogin_id']) && ($_SESSION['po_userses']['flc_usrlogin_type'] == 2 )) && ($_GET['pid'] == 'imgupload' || $_GET['pid'] == 'preview' || $_GET['pid'] == 'artistsimages')) {
            $this->redirecttohomepage();
        }
        
        
        
        /* Ends - Restrict Artist Pages */

        if ((!isset($_SESSION['po_userses']['flc_usrlogin_id']) || $_SESSION['po_userses']['flc_usrlogin_id'] == '') && ($_GET['pid'] == 'profile' || $_GET['pid'] == 'imgupload' || $_GET['pid'] == 'preview' || $_GET['pid'] == 'artistsimages' || $_GET['pid'] == 'artistspage' || $_GET['pid'] == 'editimage')) {
           /*  echo "<pre/>"; print_r($_SESSION); print_r($_GET); die;  */
			$this->redirecttohomepage();
        }

        
        
        if ($_GET['pid'] == 'register' && (!isset($_GET['workid']) || $_GET['workid'] == '' || ($_GET['workid'] != 'artist' && $_GET['workid'] != 'client' && $_GET['workid'] != 'company'))):
            $this->redirecttologinpage();
        endif;
        if ($_GET['pid'] == 'forgotpassword' && (!isset($_GET['workid']) || $_GET['workid'] == '' || ($_GET['workid'] != 'artist' && $_GET['workid'] != 'client' && $_GET['workid'] != 'company'))):
            $this->redirecttologinpage();
        endif;

        $this->sandbox = TRUE;

        // Set PayPal API version and credentials.
        $this->api_version = '85.0';
        $this->api_endpoint = $this->sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
        $this->api_username = $this->sandbox ? 'ajesh.nair.testacc-1_api1.gmail.com' : 'LIVE_USERNAME_GOES_HERE';
        $this->api_password = $this->sandbox ? 'TW22JMYWPLXYHHFK' : 'LIVE_PASSWORD_GOES_HERE';
        $this->api_signature = $this->sandbox ? 'AFcWxV21C7fd0v3bYYYRCpSSRl31A1vBNsBLCRK0xCNlcPwFaldsIB2c' : 'LIVE_SIGNATURE_GOES_HERE';
    }
    function getuserimages() {
         $uid = $_SESSION['po_userses']['flc_usrlogin_id'];
        if((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist']!='')){
            $uid = $_SESSION['current_artist'];
        } 
        $qry = "SELECT * FROM tbl_user_images WHERE status=1 AND user_id = '" .$uid . "' ORDER BY cr_date DESC";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getuserimagedetailbyid($imgid) {
        $qry = "SELECT * FROM tbl_user_images WHERE id = '" . clear_input($imgid) . "' and status IN (0,1) LIMIT 1";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getuserimagesubcatdetails($imgid) {
        $qry = "SELECT * FROM tbl_users_sub_category_images WHERE userimage_id = '" . clear_input($imgid) . "' and status IN (0,1) LIMIT 1";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function checkpaymentusermusic($userid, $imgid, $type) {
        $qry = "SELECT id FROM tbl_sales WHERE uid = '" . clear_input($userid) . "' and pid = '" . clear_input($imgid) . "' and type = '" . clear_input($type) . "'";
        return $result = $this->modelObj->numRows($qry);
    }

    function getuserimagelistbycatid($catid) {
        $qry = "SELECT * FROM tbl_user_images WHERE status=1 AND user_id = '" . $_SESSION['po_userses']['flc_usrlogin_id'] . "' AND category_id = '" . $catid . "' ORDER BY image_rank ASC";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getuserimageinactivelistbycatid() {
        
        $uid = $_SESSION['po_userses']['flc_usrlogin_id'];
        if((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist']!='')){
            $uid = $_SESSION['current_artist'];
        } 
        $qry = "SELECT * FROM tbl_user_images WHERE status=0 AND user_id = '" . $uid . "' ORDER BY image_rank ASC";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getuserbypreviewcategory($catid) {
        $qry = "SELECT id, image, first_name, last_name FROM tbl_users WHERE FIND_IN_SET('" . $catid . "', preview_category) and usertype = 1 and status = 1 ";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getAllSettings() {
        $qry = "SELECT * FROM tbl_settings WHERE Id=1";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getuserdetailbyrefid($refid) {
        $qry = "SELECT * FROM tbl_users WHERE ref_id = '" . clear_input($refid) . "' and status IN (0,1,2) LIMIT 1";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function activatereguser($userid) {
        $qry = "UPDATE tbl_users SET status = 1 WHERE id = '" . clear_input($userid) . "' and status = 0";
        return $result = $this->modelObj->runQuery($qry);
    }

    function checkifuserfbidexist($fb_id) {
        $qry = "SELECT fb_id FROM tbl_users WHERE fb_id = '" . clear_input($fb_id) . "' and status IN (0,1)";
        return $result = $this->modelObj->numRows($qry);
    }

    function checkifuserfbidexistbytype($fb_id, $type) {
        $qry = "SELECT fb_id FROM tbl_users WHERE fb_id = '" . clear_input($fb_id) . "' and usertype = '" . clear_input($type) . "' and status IN (0,1)";
        return $result = $this->modelObj->numRows($qry);
    }

    function checkifuseremailexist($emailid) {
        $qry = "SELECT emailid FROM tbl_users WHERE emailid = '" . clear_input($emailid) . "' and status IN (0,1)";
        return $result = $this->modelObj->numRows($qry);
    }

    function checkifuseremailexistbytype($emailid, $type) {
        $qry = "SELECT emailid FROM tbl_users WHERE emailid = '" . clear_input($emailid) . "' and usertype = '" . clear_input($type) . "' and status IN (0,1)";
        return $result = $this->modelObj->numRows($qry);
    }

    function checkifusernameexist($username) {
        $qry = "SELECT emailid FROM tbl_users WHERE username = '" . clear_input($username) . "' and status IN (0,1)";
        return $result = $this->modelObj->numRows($qry);
    }

    function getuserdetailfromusername($username) {
        $qry = "SELECT * FROM tbl_users WHERE username = '" . clear_input($username) . "' and status IN (0,1)";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getuserdetailfromuserid($userid) {
        $qry = "SELECT * FROM tbl_users WHERE id = '" . clear_input($userid) . "' and status IN (0,1)";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function checkiffolloweremailexist($emailid) {
        $qry = "SELECT * FROM tbl_followers WHERE follower_emailid = '" . clear_input($emailid) . "' and following_site_or_artist = 0 and status IN (0,1) LIMIT 1";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function checkiffollowingartsit($emailid, $artistid) {
        $qry = "SELECT * FROM tbl_followers WHERE follower_emailid = '" . clear_input($emailid) . "' and artist_id = '" . clear_input($artistid) . "' and following_site_or_artist = 1 and status IN (0,1) LIMIT 1";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getcategorylist() {
        $qry = "SELECT * FROM tbl_category WHERE status = 1";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getimgcategorylist() {
        $qry = "SELECT * FROM tbl_category WHERE status = 1 and id!=13 and id!=14 and id!=15";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getcategorybyplan($planid) {
        $qry1 = "SELECT * FROM tbl_plans WHERE id='" . $planid . "'";
        $row1 = $this->modelObj->fetchRow($qry1);

        $qry = "SELECT * FROM tbl_category WHERE status = 1 and find_in_set(id,'" . $row1['category'] . "')";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getsubcategorylist($catid) {
		$loggeduser = $_SESSION['po_userses']['flc_usrlogin_id'];
       
        if((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist']!='')){
            $loggeduser = $_SESSION['current_artist'];
        }
        
        
        $qry = "SELECT * FROM tbl_users_sub_categories WHERE status = 1 and cat_id='" . $catid . "' AND user_id=$loggeduser";
       /*  $qry = "SELECT * FROM tbl_users_sub_categories WHERE status = 1 and cat_id='" . $catid . "' "; */
        return $result = $this->modelObj->fetchRows($qry);
    }
    function getsubcategorylistbyartist($catid,$artis_id) {
		//$loggeduser = $_SESSION['po_userses']['flc_usrlogin_id'];
        $qry = "SELECT * FROM tbl_users_sub_categories WHERE status = 1 and cat_id in (" . $catid . ") AND user_id=$artis_id";
       /*  $qry = "SELECT * FROM tbl_users_sub_categories WHERE status = 1 and cat_id='" . $catid . "' "; */
        return $result = $this->modelObj->fetchRows($qry);
    }
    
    
    function getadvertiselist() {
        $qry = "SELECT * FROM tbl_advertisement WHERE status = 1";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getHomeVideo() {
        $qry = "SELECT * FROM tbl_video WHERE status = 1";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getcategorylistbyids($category) {
        $qry = "SELECT * FROM tbl_category WHERE id IN (" . clear_input($category) . ") AND status = 1 ORDER BY categoryName ASC";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getcategorydetailbyid($catid) {
        $qry = "SELECT * FROM tbl_category WHERE id = '" . clear_input($catid) . "' and status = 1 LIMIT 1";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getsubcategorylistbyusercatids($userid, $category) {
        $qry = "SELECT * FROM tbl_users_sub_categories WHERE user_id = '" . clear_input($userid) . "' AND cat_id = '" . clear_input($category) . "' AND status = 1 ORDER BY sub_category_title ASC";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getimagesbySubcatCatUserid($userid, $categoryid, $subcatid) {
        if ($subcatid != 0 && $subcatid > 0):
            $qry = "SELECT sci.id as sciid, ui.* FROM tbl_users_sub_category_images as sci, tbl_user_images as ui WHERE sci.userimage_id = ui.id AND ui.status = 1 AND sci.user_id = '" . clear_input($userid) . "' AND sci.cat_id = '" . clear_input($categoryid) . "' AND sci.subcat_id = '" . clear_input($subcatid) . "' AND sci.status = 1 ORDER BY ui.image_rank ASC";
        else:
            $qry = "SELECT * FROM tbl_user_images WHERE status = 1 AND user_id = '" . clear_input($userid) . "' AND category_id = '" . clear_input($categoryid) . "' AND id NOT IN (SELECT sci.userimage_id FROM tbl_users_sub_category_images as sci WHERE sci.user_id = '" . clear_input($userid) . "' AND sci.cat_id = '" . clear_input($categoryid) . "' AND sci.status = 1 and sci.subcat_id!=0)  ORDER BY image_rank ASC";
        endif;
        //echo $qry;
        return $result = $this->modelObj->fetchRows($qry);
    }

    function checkifimageexistinsubcat($userid, $categoryid, $subcatid, $usrimgid) {

        $qry = "SELECT id FROM tbl_users_sub_category_images WHERE user_id = '" . clear_input($userid) . "' AND cat_id = '" . clear_input($categoryid) . "' AND subcat_id = '" . clear_input($subcatid) . "' AND userimage_id = '" . clear_input($usrimgid) . "' AND status = 1 ";
        return $result = $this->modelObj->numRows($qry);
    }

    function addimagetosubcategory($userid, $categoryid, $subcatid, $usrimgid) {

        $qry = "INSERT INTO tbl_users_sub_category_images (user_id, cat_id, subcat_id, userimage_id, cr_date, status) VALUES('" . clear_input($userid) . "', '" . clear_input($categoryid) . "', '" . clear_input($subcatid) . "', '" . clear_input($usrimgid) . "', NOW(), 1) ";
        return $result = $this->modelObj->runQuery($qry);
    }

    function removeimagefromsubcategory($userid, $categoryid, $subcatid, $usrimgid) {

        $qry = "DELETE FROM tbl_users_sub_category_images WHERE user_id = '" . clear_input($userid) . "' AND cat_id = '" . clear_input($categoryid) . "' AND subcat_id = '" . clear_input($subcatid) . "' AND userimage_id = '" . clear_input($usrimgid) . "' AND status = 1 ";
        return $result = $this->modelObj->runQuery($qry);
    }

    function removeimagefromallsubcategory($userid, $categoryid, $subcatid, $usrimgid) {

        $qry = "DELETE FROM tbl_users_sub_category_images WHERE user_id = '" . clear_input($userid) . "' AND cat_id = '" . clear_input($categoryid) . "' AND userimage_id = '" . clear_input($usrimgid) . "' AND status = 1 ";
        return $result = $this->modelObj->runQuery($qry);
    }

    function getartistpreivepagedata($userid, $catid) {

        $qry = "SELECT * FROM tbl_userpreview_data_category WHERE user_id = '" . clear_input($userid) . "' AND category_id = '" . clear_input($catid) . "' AND status = 1 LIMIT 1 ";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getartistpreivepagedatacategory($userid, $catid) {

        $qry = "SELECT * FROM tbl_userpreview_data_category WHERE user_id = '" . clear_input($userid) . "' AND status = 1 AND category_id = '" . clear_input($catid) . "' LIMIT 1 ";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function checkifpreviewheaderexist($userid, $cateid) {

        $qry = "SELECT id FROM tbl_userpreview_data_category WHERE user_id = '" . clear_input($userid) . "' AND category_id = '" . clear_input($cateid) . "' AND status = 1 ";

        return $result = $this->modelObj->numRows($qry);
    }

    function addpreviewpageheaderfootersidebar($userid, $contentheader, $contentfooter, $contentsidebar, $catid) {

        $qry = "INSERT INTO tbl_userpreview_data_category (user_id,category_id, preview_header, preview_footer, preview_sidebar, cr_date, status) VALUES('" . clear_input($userid) . "','" . clear_input($catid) . "', '" . clear_input($contentheader) . "', '" . clear_input($contentfooter) . "', '" . clear_input($contentsidebar) . "', NOW(), 1) ";


        return $result = $this->modelObj->runQuery($qry);
    }

    function updatepreviewpageheader($userid, $contentheader, $cateid) {

        $qry = "UPDATE tbl_userpreview_data_category SET preview_header = '" . clear_input($contentheader) . "' WHERE user_id = '" . clear_input($userid) . "' AND category_id = '" . clear_input($cateid) . "' AND status = 1";

        return $result = $this->modelObj->runQuery($qry);
    }

    function updatepreviewpagefooter($userid, $contentfooter, $cateid) {

        $qry = "UPDATE tbl_userpreview_data_category SET preview_footer = '" . clear_input($contentfooter) . "' WHERE user_id = '" . clear_input($userid) . "' AND category_id = '" . clear_input($cateid) . "' AND status = 1";


        return $result = $this->modelObj->runQuery($qry);
    }

    function updatepreviewpagesidebar($userid, $contentsidebar, $cateid) {

        $qry = "UPDATE tbl_userpreview_data_category SET preview_sidebar = '" . clear_input($contentsidebar) . "' WHERE user_id = '" . clear_input($userid) . "' AND category_id = '" . clear_input($cateid) . "' AND status = 1";
        return $result = $this->modelObj->runQuery($qry);
    }

    function getcurrencylist() {
        $qry = "SELECT * FROM tbl_currency WHERE status = 1";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getcurrencydetailbyid($currency) {
        $qry = "SELECT * FROM tbl_currency WHERE status = 1 AND id='" . clear_input($currency) . "' ";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getnewsletterbyartistid($artistid) {
        $qry = "SELECT * FROM tbl_newsletter WHERE artist_id = '" . clear_input($artistid) . "' and status = 1";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getnewsletterdetailbyid($newsletterid) {
        $qry = "SELECT * FROM tbl_newsletter WHERE status = 1 AND id='" . clear_input($newsletterid) . "' ";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getArtistFollowerList($artistid) {
        $qry = "SELECT * FROM tbl_followers WHERE following_site_or_artist = 1 and artist_id = '" . clear_input($artistid) . "' and status = 1";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function checkIfAlreadyInvitedToChat($artistid) {
        $qry = "SELECT * FROM tbl_chat WHERE senderid='" . clear_input($_SESSION['po_userses']['flc_usrlogin_id']) . "' and receiverid = '" . clear_input($artistid) . "' and status = 1";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getAllChatList() {
        $userid = $_SESSION['po_userses']['flc_usrlogin_id'];
        $qry = "SELECT *, IF(senderid = '" . clear_input($userid) . "', 1, 2) as senderorreceiver FROM tbl_chat WHERE (senderid = '" . clear_input($userid) . "' OR receiverid = '" . clear_input($userid) . "') and status = 1";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getUserNameFromId($userid) {
        $qry = "SELECT first_name, last_name FROM tbl_users WHERE id='" . clear_input($userid) . "' and status = 1";
        $result = $this->modelObj->fetchRow($qry);
        return $result['first_name'] . " " . $result['last_name'];
    }

    function checkIfInviteCodeisValidOrNot($chatInviteCode, $chatdata) {
        $qry = "SELECT invite_code, senderid, receiverid FROM tbl_chat WHERE id='" . clear_input($chatdata) . "' and invite_code = '" . clear_input($chatInviteCode) . "' and status = 1";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getChatDetailList($chatdata) {
        $qry = "SELECT * FROM tbl_chat_message WHERE chatid='" . clear_input($chatdata) . "' and status = 1 ORDER BY cr_date ASC";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function redirecttologinpage() {
        header("Location: " . $_SESSION['FRNT_DOMAIN_NAME'] . "login/");
    }

    function redirecttohomepage() {
        header("Location: " . $_SESSION['FRNT_DOMAIN_NAME'] . "home/");
    }

    function getPagetTitleAndHeading() {
        
        if ($_GET['pid'] == 'home' || $_GET['pid'] == 'homenew') {
            $pageTitle = "Home";
            $h1 = "Home";
            $image = "default.png";
        } else if ($_GET['pid'] == 'login') {
            $pageTitle = "Login";
            $h1 = "Login";
            $image = "default.png";
        } else if ($_GET['pid'] == 'register') {
            $pageTitle = "Register";
            $h1 = "Register";
            $image = "default.png";
        } else if ($_GET['pid'] == 'profile') {
            $pageTitle = "Edit Profile";
            $h1 = "Edit Profile";
            $image = "default.png";
        } else if ($_GET['pid'] == 'changepassword') {
            $pageTitle = "Change Password";
            $h1 = "Change Password";
            $image = "default.png";
        } else if ($_GET['pid'] == '') {
            $pageTitle = "Home";
            $h1 = "Home";
            $image = "default.png";
        } else if ($_GET['pid'] == 'plans') {
            $pageTitle = "Select Package";
            $h1 = "Select Package";
            $image = "default.png";
        } else if ($_GET['pid'] == 'payment') {
            $pageTitle = "Payment";
            $h1 = "Payment";
            $image = "default.png";
        } else if ($_GET['pid'] == 'forgotpassword') {
            $pageTitle = "Forgot Password";
            $h1 = "Forgot Password";
            $image = "default.png";
        } else if ($_GET['pid'] == 'imgupload') {
            $pageTitle = "Image Upload";
            $h1 = "Image Upload";
            $image = "default.png";
        } else if ($_GET['pid'] == 'radio') {
            $pageTitle = "Radio Host";
            $h1 = "Radio Host";
            $image = "default.png";
        } else if ($_GET['pid'] == 'preview') {
            $pageTitle = "Manage Preview";
            $h1 = "Manage Preview";
            $image = "default.png";
        } else if ($_GET['pid'] == 'artistsimages') {
            $pageTitle = "My Images";
            $h1 = "My Images";
            $image = "default.png";
        } else if ($_GET['pid'] == 'artistlist') {
            $pageTitle = "Artist List";
            $h1 = "Artist List";
            $image = "default.png";
        } else if ($_GET['pid'] == 'artistpreview') {
            $pageTitle = "Artist Preview";
            $h1 = "Artist Preview";
            $image = "default.png";
        } else if ($_GET['pid'] == 'newsletter') {
            $pageTitle = "Newsletter";
            $h1 = "Newsletter";
            $image = "default.png";
        } 
        else if ($_GET['pid'] == 'artistspage') {
            $pageTitle = "Artists Page";
            $h1 = "Artists Page";
            $image = "default.png";
        }
        else if ($_GET['pid'] == 'notification' or $_GET['pid'] == 'accessdetail') {
            $pageTitle = "Notificatoins";
            $h1 = "Notificatoins";
            $image = "default.png";
        }
        
        
        //accessdetail
        else {
            $pageTitle = "No Page Found";
            $h1 = "No Page Found";
            $image = "default.png";
        }

        return $pageTitle . "@" . $h1 . "@" . $image;
    }

    function time_elapsed2($start, $end) {
        $start = new DateTime($start);
        $end = new DateTime($end);

        $interval = $end->diff($start);

        /* $units = array(
          "%y" => sp("year", "years"),
          "%m" => sp("month", "months"),
          "%d" => sp("day", "days"),
          "%h" => sp("hour", "hours"),
          "%i" => sp("minute", "minutes"),
          "%s" => sp("second", "seconds")
          ); */
        $units = array(
            "%y" => $this->sp("year", "years"),
            "%m" => $this->sp("month", "months"),
            "%d" => $this->sp("d", "d"),
            "%h" => $this->sp("h", "h"),
            "%i" => $this->sp("m", "m"),
            "%s" => $this->sp("s", "s")
        );

        $result = array();
        foreach ($units as $format_char => $names) {
            $formatted_value = $interval->format($format_char);
            if ($formatted_value == "0") {
                continue;
            }
            $result[] = $this->get_formatted_string($formatted_value, $names);
        }

        return implode(", ", $result);
    }

    function NVPToArray($NVPString) {
        $proArray = array();
        while (strlen($NVPString)) {
            // name
            $keypos = strpos($NVPString, '=');
            $keyval = substr($NVPString, 0, $keypos);
            // value
            $valuepos = strpos($NVPString, '&') ? strpos($NVPString, '&') : strlen($NVPString);
            $valval = substr($NVPString, $keypos + 1, $valuepos - $keypos - 1);
            // decoding the respose
            $proArray[$keyval] = urldecode($valval);
            $NVPString = substr($NVPString, $valuepos + 1, strlen($NVPString));
        }
        return $proArray;
    }

    function sp($singular, $plural) {
        return array("singular" => $singular, "plural" => $plural);
    }

    function get_formatted_string($formatted_value, $names) {
        $result = $formatted_value . " ";
        if ($formatted_value == "1") {
            $result .= $names["singular"];
        } else {
            $result .= $names["plural"];
        }
        return $result;
    }

    function getUniversityList() {
        $qry = "SELECT * FROM tbl_university WHERE status = 1 ORDER BY uni_name";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getCollegeList() {
        $qry = "SELECT * FROM tbl_college WHERE status = 1 ORDER BY uni_name";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getCollegeListByUniversity($uni_id) {
        $qry = "SELECT * FROM tbl_college WHERE status = 1 AND uni_id = '" . clear_input($uni_id) . "' ORDER BY col_name";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function getClintIp() {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
            $ip = getenv("REMOTE_ADDR");
        } else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = "unknown";
        }

        $location = 'http://api.ipinfodb.com/v3/ip-city/?key=e3349504907aa03b26486fa4ebfb35abd158b06e8705f9358bcad1a27db91602&ip=' . $ip . '&format=json';

        $newvar = '[' . file_get_contents($location) . ']';
        $arrCnt = json_decode($newvar);
        //print_r($cntNm=$arrCnt[0]);
        return $cntNm = $arrCnt[0]->{'countryCode'};
    }

    function getAllCountryList() {

        //$qry = "SELECT * FROM tbl_country WHERE status = 1 ORDER BY countryName ASC";
        // $qry = "SELECT * FROM tbl_country WHERE status = 1 ORDER BY countryName ASC";
        $qry = "SELECT * FROM countries ORDER BY name ASC";

        return $result = $this->modelObj->fetchRows($qry);
    }

    function getStateListByCountry($countryid) {

        // $qry = "SELECT * FROM tbl_state WHERE status = 1 AND countryId = '" . clear_input($countryid) . "' ORDER BY stateName ASC";
        // $qry = "SELECT * FROM tbl_state WHERE status = 1 AND countryId = '" . clear_input($countryid) . "' ORDER BY stateName ASC";
        $qry = "SELECT * FROM regions WHERE  country_id = '" . clear_input($countryid) . "' GROUP BY name ORDER BY name ASC";

        return $result = $this->modelObj->fetchRows($qry);
    }

    function getCityListByState($stateid) {

        // $qry = "SELECT * FROM tbl_city WHERE stateId = '" . clear_input($stateid) . "' AND status = 1 ORDER BY cityName ASC";
        //$qry = "SELECT * FROM tbl_city WHERE stateId = '" . clear_input($stateid) . "' AND status = 1 ORDER BY cityName ASC";
        $qry = "SELECT * FROM cities WHERE region_id = '" . clear_input($stateid) . "' GROUP BY name ORDER BY name ASC";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function userDetails($user_id, $catid) {
        $query = "SELECT profile_pic,profile_background,profile_background_position  FROM tbl_userpreview_data_category WHERE user_id='$user_id' and category_id='$catid' ";
        //$data = mysqli_fetch_array($query, MYSQLI_ASSOC);
        return $result = $this->modelObj->fetchRow($query);
    }

    /* Intro Tour Check */

    function userBackgroundUpdate($user_id, $actual_image_name, $cat) {
        $qry = "SELECT * FROM tbl_userpreview_data_category WHERE user_id='$user_id' and category_id='$cat'";
        //$result = $this->modelObj->fetchRows($qry);
        $result = $this->modelObj->numRows($qry);
        
        if($result > 0){
            $query = "UPDATE tbl_userpreview_data_category SET profile_pic='$actual_image_name'  WHERE user_id='$user_id' and category_id='$cat'";
           
        }else{
            $query = "insert into tbl_userpreview_data_category SET profile_pic='$actual_image_name',user_id='$user_id',category_id='$cat',status='1'";
        }
        //return $query;
        
        return $result = $this->modelObj->runQuery($query);
    }

    /* Intro Tour Check */

    function userBackgroundPositionUpdate($user_id, $position, $cat) {
        //$position = mysqli_real_escape_string($this->db, $position);
        
        
        $qry = "SELECT * FROM tbl_userpreview_data_category WHERE user_id='$user_id' and category_id='$cat'";
        //$result = $this->modelObj->fetchRows($qry);
        $result = $this->modelObj->numRows($qry);
        if($result > 0){
            $query = "UPDATE tbl_userpreview_data_category SET profile_background_position='$position' WHERE user_id='$user_id' and category_id='$cat'";
           
        }else{
            $query = "insert into tbl_userpreview_data_category SET profile_background_position='$position',user_id='$user_id',category_id='$cat',status='1'";
        }
       
        //return $query;
        return $result = $this->modelObj->runQuery($query);
    }

    function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }

        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    function getpreviewcategoriesfromother() {
        $qry = "SELECT preview_category FROM tbl_users WHERE status = 1 AND id = " . $_SESSION['po_userses']['flc_usrlogin_id'];
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getusercatimageonhome($catid, $artistid) {
        $qry = "SELECT * FROM tbl_userpreview_data_category WHERE user_id = '" . $artistid . "' AND category_id = '" . $catid . "'";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function homesponserlists() {
        $qry = "SELECT * FROM tbl_sponser WHERE status=1 ORDER BY cr_date desc limit 8";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function checkPromocode($promocode) {
        $qry = "SELECT * FROM tbl_promocode WHERE status=1 and promocode='" . $promocode . "'";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function checkembedcode($embedcode) {
        $qry = "SELECT * FROM `tbl_users` WHERE status=1 and username='" . $embedcode . "'";
        return $result = $this->modelObj->fetchRow($qry);
    }
    function getcategorydetailbyUserId($user_id,$catid) {
       $qry = "SELECT * FROM tbl_userpreview_data_category WHERE category_id = '" . clear_input($catid) . "' and user_id = '". clear_input($user_id)."' and status = 1 LIMIT 1";
        return $result = $this->modelObj->fetchRow($qry);
    }
    //Check Artist can access company pages or not
    function checkcompanypageAccess($access,$catid=''){
        if($_SESSION['current_artist']!=''){
            $qry = "SELECT * FROM tbl_company_artists_assign WHERE company_id = '" . clear_input($_SESSION['po_userses']['flc_usrlogin_id']) . "' and artist_id = '". clear_input($_SESSION['current_artist'])."' and status = 1 LIMIT 1";
            $result = $this->modelObj->fetchRow($qry);
            $acc = 0;
            if($result['access_approved']!=''){
                $ar = explode(",", $result['access_approved']);
            }
            switch ($access){
                case 'full_profile_access':
                    if($result['full_profile_access']=='on' or $result['full_profile_access']!=''){
                        if(in_array("1",$ar)){
                            $acc = 1;    
                        }
                    }
                    break;
                case 'sidebar_access':
                    
                    if($result['sidebar_access']=='on' or $result['sidebar_access']!=''){
                         if(in_array("2",$ar)){
                            $acc = 1;    
                        }
                    }
                    break;
                case 'categories_access':
                    if($result['categories_access']!=''){
                        if(in_array("3",$ar)){
                            $acc = 1;    
                        }
                    }
                    break;
                case 'sub_category_access':
                     if($result['sub_category_access']!=''){
                        if(in_array("4",$ar)){
                            $acc = 1;    
                        }
                    }
                    break;
                default:
                    $acc = 0;
                    break;
            }
        }else{
            $acc = 0;
        }
        return $acc;
    }
    function getcompanypageSubCatAccess(){
        $qry = "SELECT sub_category_access FROM tbl_company_artists_assign WHERE company_id = '" . clear_input($_SESSION['po_userses']['flc_usrlogin_id']) . "' and artist_id = '". clear_input($_SESSION['current_artist'])."' and status = 1 LIMIT 1";
        $result = $this->modelObj->fetchRow($qry);
        if($result['sub_category_access']==''){
            $res = 'empty';
        }else{
            $res = $result['sub_category_access'];
        }
        
        return $res;
    }
    function getcompanypageCatAccess(){
        $qry = "SELECT categories_access FROM tbl_company_artists_assign WHERE company_id = '" . clear_input($_SESSION['po_userses']['flc_usrlogin_id']) . "' and artist_id = '". clear_input($_SESSION['current_artist'])."' and status = 1 LIMIT 1";
        $result = $this->modelObj->fetchRow($qry);
        return $result['categories_access'];
    }
    function getWalletDetail() {
        $qry = "SELECT * FROM tbl_user_wallet WHERE user_id='".clear_input($_SESSION['po_userses']['flc_usrlogin_id'])."'";
        return $result = $this->modelObj->fetchRow($qry);
    }
    function getUserPurchaseHistory($user_id) {
        $qry = "SELECT * FROM tbl_user_purchase_history WHERE buyer_id='".$user_id."'";
        return $result = $this->modelObj->fetchRows($qry);
    }
    function getHistoryArtistDetail($item_id){
        $qry = "SELECT u.*,ud.* FROM tbl_user_images ud left join tbl_users u ON u.id=ud.user_id WHERE ud.id='".$item_id."'";
        return $result = $this->modelObj->fetchRows($qry);
    }
    function getSellerDetail($user_id){
        $qry = "SELECT up.*,u.*,ud.* FROM tbl_user_purchase_history up left join tbl_user_images ud ON ud.user_id=up.seller_id left join tbl_users u ON u.id=ud.user_id WHERE up.seller_id='".$user_id."'";
        return $result = $this->modelObj->fetchRows($qry);
    }
}

?>