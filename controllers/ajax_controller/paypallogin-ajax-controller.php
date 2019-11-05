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
session_start();
$session_uid = '1'; // $_SESSION['user_id'];
$uid = $_SESSION['po_userses']['flc_usrlogin_id'];
if ((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist'] != '')) {
    $uid = $_SESSION['current_artist'];
}

if (isset($_POST['action']) && $_POST['action'] == 'register_with_paypal') {
    $params = array();
    parse_str($_POST['register'], $params);

    $usertype = $params['register_type'];
    $promocodedetail = 1;

    if ($params['promocode'] != '') {
        $qry = "SELECT * FROM tbl_promocode WHERE status=1 and promocode='" . $params['promocode'] . "' and email_address='" . $params['emailid'] . "'";
        $result = $modelObj->fetchRow($qry);


        if ($result['id'] != '') {
            if ($result['is_used'] == 1) {
                $promocodedetail = 2;
            } else if ($result['user_type'] != $usertype) {
                $promocodedetail = 3;
            } else {
                $promocodedetail = 4;
            }
        } else {
            $promocodedetail = 0;
        }
    }

    if ($promocodedetail == 0) {
        $msg = 'Invalid Promo Code. This promo code not exist.';
    } elseif ($promocodedetail == 2) {
        $msg = 'Promo Code Expired. This promo code already used.';
    } elseif ($promocodedetail == 3) {
        $msg = 'Invalid Promo Code. This promo code not exist for this user type.';
    } else {
        if ($promocodedetail == 4) {
            $planid = 3;
            $plannm = 'Gold';
        } else {
            $planid = 1;
            $plannm = 'Basic';
        }

        $sql1 = "select * from tbl_plans WHERE id = '$planid' or plan_name='$plannm'";
        $dd = $modelObj->fetchRow($sql1);
        $ref_code = "ART" . date("mdyHis") . rand(10, 99);
        $first_name = $params['first_name'];
        $last_name = $params['last_name'];
        $username = $params['username'];
        $password = $params['password'];
        $country = $params['country'];
        $region = $params['region'];
        $city = ($params['city'] ? $params['city'] : 0);
        $address = $params['address'];
        $gender = 'male';
        $emailid = $params['emailid'];

        $qry = "INSERT INTO tbl_users (ref_id,is_paypal_user, first_name, last_name, username, emailid, password, country, state, city,latitude,longitude, gender, address, usertype, cr_date, status,plan_id,paypal_email_id,paypal_email_show,image_limit,preview_category) values('" . $ref_code . "','yes' ,'" . $first_name . "', '" . $last_name . "', '" . $username . "', '" . $emailid . "', '" . md5($password) . "', '" . $country . "', '" . $region . "', '" . $city . "','0', '0', '" . $gender . "', '" . $address . "', '" . $usertype . "', NOW(), 1,'" . $planid . "','" . $emailid . "','1','" . $dd['image_limit'] . "','')";
        $result = $modelObj->runQuery($qry);
        $lastinsertedid = mysql_insert_id();

        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] != '127.0.0.1'){
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '127.0.0.1'){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if (isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED'] != '127.0.0.1'){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        }
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR'] != '127.0.0.1'){
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        else if (isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED'] != '127.0.0.1'){
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        }
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != '127.0.0.1'){
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }
        else{
            $ipaddress = 'UNKNOWN';
        }

        $qry1 = "INSERT INTO tbl_user_login_history (user_id,emailid,last_login,ip_address) values('" . $lastinsertedid . "','".$emailid."','".date("Y-m-d h:i:s")."','".$ipaddress."')";
        $result1 = $modelObj->runQuery($qry1);
        
        
        $to = $emailid;

        // subject
        $subject = 'Congratulations from Mentallica';
        //echo "-2-".$to;
        if ($usrtyp == 1):
            // message
            $message = '<p>Hello</p>
		<p>Click or copy paste below link in you browser to activate your account:</p>
		<p><a href="' . $activationlink . '">' . $activationlink . '</a></p>
		<p>Congratulation you have been accepted to the Metallica Art Community . Mentallica is a platform for Marriage of the Arts as it links different art forms like Art as an timeless expression of our views and feelings.</p>
		<p>So it links Artists , is a window to the world ( shopping window or just display window ) as well as a portable Portfolio for the Artist. And therefore can be seen as an Artistic interim as well responding  to job postings by logged in clientele as  well as cooperation demands by fellow Artists.</p>
		<p>So enjoy your new Membership by signing in/logging in with your used email in and received temporary password  in this message.  </p>
		<p>Do not forget to change your password to your own choice once you log in. Or afterwards.</p>
		<p>On this Personal  Profile Page you also find all the info back you have given us while sign in please keep this updated so that the Administrator and interested parties can locate you.</p>
		<p>Once you login to your page you will find 3 different payment plans.</p>
		<p>The first is a test payment plan and works with a token of ten credits.  </p>
		<p>The purpose of this one is mainly extra needed credits if the chosen subscription is not sufficient during  a certain period or can be granted as bonus credits by the administrator to any subscription plan.</p>
		<p>The second is a Silver membership of Mentallica our Basic subscription.</p>
		<p>This  6$ monthly subscription /paid yearly  contains  50 uploads monthly  in one given category and can be upgraded with extra uploads by the use of Tokens.</p>
		<p>The third is a Gold subscription for 10$ monthly /paid yearly  really unleashes the power of your Mentallica Membership with more features to come as we grow our community.</p>
		<p></p>It comes with 500 uloads in any category and with a special zoom feature for displaying your Art work So you don’t have to make numerous detail pictures.  </p>
		<p>For sales Mentallica is like your own Agent without the fees.</p>
		<p>The interested client needs to be log in to contact you but price discussions are solely between you and the client for the price or price range you set.</p>
		<p>SO BE YOUR OWN AGENT ( OR ASK ASSISTANCE FROM THE MENTALLICA TEAM )</p>
		<p>Enjoy!</p>';
        elseif ($usrtyp == 2):
            $message = '<p>Hello, </p>
			<p>Click or copy paste below link in you browser to activate your account:</p>
			<p><a href="' . $activationlink . '">' . $activationlink . '</a></p>
			<p>Bidding on the site is regulated.  Since it`s a site managed by the Artist himself he probably wans to spend more time creating his Art work then selling it.
			The status of logged in client gives you the opportunity to chat with the Artist himself in the specially designed chat window. Even if the status light shows he is not logged in himself it remains a preferred way to contact him or her.  That`s why credits are sold to  contact your preferred artist to show him it`s  serious chat or email ( when the Artist is offline ) just type in your question as you would while sending him an email. </p>

			<p>If you logged in without credits on your token card that are used to initialize a chat  you will nevertheless get to see the chat window as a registered client but won`t be able to send messages. We as Mentallica community will ask the Artist to give updated information to prevent that a piece of displayed Art is already sold while you make your bid.</p>

			<p>Hope you will get to be able to purchase your favorite piece and thank you for being supportive of the Mentallica community.</p>';
        elseif ($usrtyp == 3):
            $message = '<p>Hello, </p>
			<p>Click or copy paste below link in you browser to activate your account:</p>
			<p><a href="' . $activationlink . '">' . $activationlink . '</a></p>
			<p>As a necessary or preferred link to the creation of Art pieces we are glad to have you so close to us. Producers can shop here for an Artist to represent as well as promote their company n one or more categories. This sign-up sign-in is solely provided so that sponsors/Producers/Gallery holders can upload their imagery directly to our servers to be edited later by Mentallica to be displayed. Several different subscription types are available depending on the amount and durance of displayed commercials contact us for a very interesting offer. Tokens are used to upload to the mentallica server only and start editing work. Here also a chat window will be available to give instructions to or buy space n time on the mentallica server. </p>

				<p>Thank you for being a help for our Artists</p>';
        endif;
        //echo "-3-";
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";

        //$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\n";

        // Additional headers
        $headers .= 'From: ProjectOne <ajshnr@gmail.com>' . "\r\n";

        // Mail it
        @mail($to, $subject, $message, $headers);
        //echo "-4-";
        
        require('../paypal-login-controller.php');
        $obj = new PaypalLoginController();
        $result = $obj->_payapcheckuser($emailid);

        $_SESSION['po_userses']['flc_usrlogin_id'] = $result['id'];
        $_SESSION['po_userses']['flc_usrlogin_ref_id'] = $result['ref_id'];
        $_SESSION['po_userses']['flc_usrlogin_first_nm'] = $result['first_name'];
        $_SESSION['po_userses']['flc_usrlogin_last_nm'] = $result['last_name'];
        $_SESSION['po_userses']['flc_usrlogin_email'] = $result['emailid'];
        $userthumb = $_SESSION['SITE_IMG_PATH'] . "artist/thumb/" . $result['image'];
        if ($result['image'] != '' && is_file($userthumb)):
            $_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME'] . "upload/artist/thumb/" . $result['image'];
        else:
            $_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME'] . "upload/artist/default_profile_pic.jpg";
        endif;
        $_SESSION['po_userses']['flc_usrlogin_type'] = $result['usertype'];
        $_SESSION['po_userses']['flc_usrlogin_type_word'] = $result['usertype'] == 1 ? "Artist" : ( $result['usertype'] == 2 ? "Client" : ($result['usertype'] == 3 ? "Company" : ""));
        $_SESSION['po_userses']['flc_usrlogin_plan'] = $result['plan_id'];
        setcookie("rem_emailid", $_GET["email"], time() + 60 * 60 * 24 * 30, "/");
        setcookie("rem_pwd", '1', time() + 60 * 60 * 24 * 30, "/");
        $msg = "success";

        $msg = array("msg" => $msg);
        echo json_encode($msg);
        die;
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'check-login') {
    $params = array();
    
    $emailAddress = $_POST['userEmail'];
   
    $qry = "SELECT * FROM tbl_users WHERE status=1 and emailid='" . $emailAddress . "'";
    $result = $modelObj->numRows($qry);
    
    if($result==0){
        echo "no-found";
    }else{
        $_SESSION['verifyEmail'] = $emailAddress;
        echo "found";
    }
   die;
}

?>