<?php
class ForgotpasswordController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new ForgotpasswordModel();
		
		if(isset($_POST['f_p_emailid']) && $_POST['f_p_emailid'] != ''):
			//if($_POST['u_r_password'] != $_POST['u_r_password2']):
			//	$_SESSION['po_userses']['login_error'] = '<h4>Unmatched password</h4><p>Please re-enter password and confirm password.</p>';
			//	$_SESSION['po_userses']['login_error_cls'] = "callout-danger";
			//else:
				$this -> usrtyp = $_GET['workid'] == 'artist' ? 1 : ($_GET['workid'] == 'client' ? 2 : ($_GET['workid'] == 'company' ? 3 : 1));
				$this -> didemailidexist = $this -> checkifuseremailexistbytype($_POST['f_p_emailid'], $this -> usrtyp);
				if($this -> didemailidexist <= 0):
					$_SESSION['po_userses']['login_error'] = '<h4>Invalid Email ID</h4><p>Email ID you entered did not exists, please try another one.</p>';
					$_SESSION['po_userses']['login_error_cls'] = "callout-danger";
				else:
					$this -> getmsg = $this -> createNewPasswordFun($_POST['f_p_emailid'], $this -> usrtyp);
					$_SESSION['po_userses']['login_error'] = '<h4>Password Sent</h4><p>Please check your email, we have sent you temporary password to login.</p>';
					$_SESSION['po_userses']['login_error_cls'] = "callout-info";
					
					header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."login/");
					exit;
				endif;
			//endif;
		endif;
	}
	function getreguserdetail($userid){
		$qry = "SELECT * FROM tbl_users WHERE id = '".clear_input($userid)."' AND status = 0 LIMIT 1";
		return $result = $this->modelObj->fetchRow($qry);
	}
	function createNewPasswordFun($emailid, $type){
		$ref_code = "ART".date("mdyHis").rand(10, 99);
	  	$qry="UPDATE tbl_users SET password = '".clear_input(md5($ref_code))."' WHERE status = 1 AND emailid = '".clear_input($emailid)."' AND usertype = '".clear_input($type)."' ";
      	$result = $this->modelObj->runQuery($qry);
		//$_SESSION['po_userses']['p_register_user'] = mysql_insert_id();

		$to=$emailid;

		// subject
		$subject = 'New Password';

		// message
		$message = '<p>Hello, </p><p>Below are your login details</p><p><b>Email Id: </b>'.$emailid.'</p>
		<p><b>Password: </b>'.$ref_code.'</p>';

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";

		//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\n";

		// Additional headers
		$headers .= 'From: ProjectOne <ajshnr@gmail.com>' . "\r\n";

		// Mail it
		@mail($to, $subject, $message, $headers);

		return $result;
	}
}
?>