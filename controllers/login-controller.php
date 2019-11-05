<?php

class LoginController extends CommonController {

    function __construct() {
        parent::__construct();
        $this->modelObj = new LoginModel();

        if (isset($_POST['u_email_id']) && $_POST['u_email_id'] != ''):
            $this->usrtyp = $_GET['workid'] == 'artist' ? 1 : ($_GET['workid'] == 'client' ? 2 : ($_GET['workid'] == 'company' ? 3 : 1));
            $this->getmsg = $this->checkLoginDetails($_POST['u_email_id'], $_POST['u_password'], $this->usrtyp);
        endif;
    }

    function checkLoginDetails($emailid, $password, $type) {
        
        if($type=='1'){
            $result = $this->checkPaypalLogin($emailid, $password, $type,'');
        }
        else if( $type=='2'){
            $result = $this->checkPaypalLogin($emailid, $password, '1','yes');
            if ($result['id'] != '' && $result['status'] == 1) {
                
                $result1 = $this->checkPaypalLogin($emailid, $password, '2','yes');
                if ($result1['id'] != '' && $result1['status'] == 1) {
                    $result = $result1;
                }else{
                    
                    $result = $result;
                     $qry = "INSERT INTO tbl_users (ref_id,is_paypal_user, first_name, last_name, username, emailid, password, country, state, city,latitude,longitude, gender, address,paypal_email_show,paypal_email_id, usertype, cr_date, status,plan_id) values('" . $result['ref_id']. "','yes', '" . $result['first_name'] . "', '" . $result['last_name'] . "', '" . $result['username'] . "', '" . $result['emailid'] . "', '" . $result['password']  . "', '" . $result['country'] . "', '" . $result['state'] . "', '" . $result['city'] . "','" . $result['latitude'] . "', '" . $result['longitude'] . "', '" .  $result['gender']  . "', '" . $result['address'] . "', '" . $result['paypal_email_show'] . "', '" . $result['paypal_email_id'] . "','" . $type . "', NOW(), 1,1)";
                    $run = $this->modelObj->runQuery($qry);
                }
            }
            $result = $this->checkPaypalLogin($emailid, $password, '2','yes');
        }
        else if($type=='3'){
            
            $result = $this->checkPaypalLogin($emailid, $password, '1','yes');
            
            if ($result['id'] != '' && $result['status'] == 1) {
                
                $result1 = $this->checkPaypalLogin($emailid, $password, '3','yes');
                if ($result1['id'] != '' && $result1['status'] == 1) {
                    $result = $result1;
                }else{
                    
                    $result = $result;
                     $qry = "INSERT INTO tbl_users (ref_id,is_paypal_user, first_name, last_name, username, emailid, password, country, state, city,latitude,longitude, gender, address,paypal_email_show,paypal_email_id, usertype, cr_date, status,plan_id) values('" . $result['ref_id']. "','yes', '" . $result['first_name'] . "', '" . $result['last_name'] . "', '" . $result['username'] . "', '" . $result['emailid'] . "', '" . $result['password']  . "', '" . $result['country'] . "', '" . $result['state'] . "', '" . $result['city'] . "','" . $result['latitude'] . "', '" . $result['longitude'] . "', '" .  $result['gender']  . "', '" . $result['address'] . "', '" . $result['paypal_email_show'] . "', '" . $result['paypal_email_id'] . "','" . $type . "', NOW(), 1,1)";
                    $run = $this->modelObj->runQuery($qry);
                }
            }
            $result = $this->checkPaypalLogin($emailid, $password, '3','yes');
        }
        
        if ($result['id'] != '' && $result['status'] == 1) {
            
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

            if (isset($_POST['remember_me']) && $_POST['remember_me'] == 1) {
                $name = $emailid;
                setcookie("rem_emailid", $name, time() + 60 * 60 * 24 * 30);
                $pswd = $password;
                setcookie("rem_pwd", $pswd, time() + 60 * 60 * 24 * 30);
            } elseif (!isset($_POST['remember_me']) && $_POST['remember_me'] != 1) {
                setcookie("rem_emailid", "", time() - 3600);
                setcookie("rem_pwd", "", time() - 3600);
            }
            
            if ($_SESSION['po_userses']['flc_usrlogin_type'] == 1) {
                //header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."home/");
                header("Location: " . $_SESSION['FRNT_DOMAIN_NAME'] . "profile/");
                exit;
            } else {
                header("Location: " . $_SESSION['FRNT_DOMAIN_NAME'] . "profile/");
                exit;
            }
        } elseif ($result['id'] != '' && $result['status'] == 0) {
            $_SESSION['po_userses']['login_error'] = '<h4>Account inactive</h4><p>Your account is inactive please contact admin to activate.</p>';
            $_SESSION['po_userses']['login_error_cls'] = "callout-danger";
        } else {
            $_SESSION['po_userses']['login_error'] = '<h4>Invalid email id or password.</h4><p>Please enter valid email id or password and try again.</p>';
            $_SESSION['po_userses']['login_error_cls'] = "callout-danger";
        }
    }
    function checkPaypalLogin($emailid, $password, $type,$is_paypal){
        $is_paypal_cond = '';
        if($is_paypal=='yes'){
            $is_paypal_cond = "and is_paypal_user = '".$is_paypal."' ";
        }
        $qry = "select * from tbl_users where status=1 and emailid = '" . clear_input($emailid) . "' and password = '" . clear_input(md5($password)) . "' and usertype = '" . clear_input($type) . "' $is_paypal_cond ";
        $result = $this->modelObj->fetchRow($qry);
        return $result;
    }

}

?>