<?php
class FbresponseController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new FbresponseModel();
		
	}
	function getreguserdetail($userid){
		$qry = "SELECT * FROM tbl_users WHERE id = '".clear_input($userid)."' AND status = 0 LIMIT 1";
		return $result = $this->modelObj->fetchRow($qry);
	}
	function getfreeplandetail(){
		$qry = "SELECT * FROM tbl_plans WHERE id = 1 AND status = 1 LIMIT 1";
		return $result = $this->modelObj->fetchRow($qry);
	}
	function userRegistrationFun($isfbuser, $fbid, $firstname, $lastname, $username, $emailid, $gender, $usrtyp, $freeplndtl){
		$ref_code = "ART".date("mdyHis").rand(10, 99);
	  	$qry="INSERT INTO tbl_users (ref_id, is_fb_user, fb_id, first_name, last_name, username, emailid, gender, usertype, cr_date, status) values('".clear_input($ref_code)."', '".clear_input($isfbuser)."', '".clear_input($fbid)."', '".clear_input($firstname)."', '".clear_input($lastname)."', '".clear_input($username)."', '".clear_input($emailid)."', '".clear_input($gender)."', '".clear_input($usrtyp)."', NOW(), 1)";
      	$result = $this->modelObj->runQuery($qry);
		//$_SESSION['po_userses']['p_register_user'] = mysql_insert_id();

      	$newuserid = mysql_insert_id();

      	if($usrtyp == 1){
      		$qry="UPDATE tbl_users SET plan_id = '".clear_input($freeplndtl['id'])."', image_limit = '".clear_input($freeplndtl['image_limit'])."' WHERE id = '".clear_input($newuserid)."' ";
      		$result = $this->modelObj->runQuery($qry);
      	}
		
		return $result;
	}
	function checkFBLoginDetails($emailid, $fbid, $type){
	  $qry="select * from tbl_users where status=1 and emailid = '".clear_input($emailid)."' and fb_id = '".clear_input($fbid)."' and usertype = '".clear_input($type)."' ";
      $result = $this->modelObj->fetchRow($qry);
	  //print_r($result);
	  //exit;
	  unset($_SESSION['fb_data']);
	  if($result['id'] != '' && $result['status'] == 1){
	  
	  	$_SESSION['po_userses']['flc_usrlogin_id'] = $result['id'];
		$_SESSION['po_userses']['flc_usrlogin_ref_id'] = $result['ref_id'];
		
		$_SESSION['po_userses']['flc_usrlogin_first_nm'] = $result['first_name'];
		$_SESSION['po_userses']['flc_usrlogin_last_nm'] = $result['last_name'];
		
		$_SESSION['po_userses']['flc_usrlogin_email'] = $result['emailid'];

		$userthumb =$_SESSION['SITE_IMG_PATH']."artist/thumb/".$result['image'];
		if($result['image'] != '' && is_file($userthumb)):
			$_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME']."upload/artist/thumb/".$result['image'];
		else:
			$_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME']."upload/artist/default_profile_pic.jpg";
		endif;
		$_SESSION['po_userses']['flc_usrlogin_type'] = $result['usertype'];
		$_SESSION['po_userses']['flc_usrlogin_type_word'] = $result['usertype'] == 1 ? "Artist" : ( $result['usertype'] == 2 ? "Client" : ($result['usertype'] == 3 ? "Company" : ""));
		$_SESSION['po_userses']['flc_usrlogin_plan'] = $result['plan_id'];
		
  		header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."profile/");
		exit;
	  }elseif($result['id'] != '' && $result['status'] == 0){
	  	$_SESSION['po_userses']['login_error'] = '<h4>Account inactive</h4><p>Your account is inactive please contact admin to activate.</p>';
		$_SESSION['po_userses']['login_error_cls'] = "callout-danger";

  		header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."login/");
		exit;
	  }else{
	  	$_SESSION['po_userses']['login_error'] = '<h4>Invalid email id or password.</h4><p>Please enter valid email id or password and try again.</p>';
		$_SESSION['po_userses']['login_error_cls'] = "callout-danger";

  		header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."login/");
		exit;
	  }
	}
}
?>