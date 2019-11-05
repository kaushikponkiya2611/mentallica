<?php
class PaymentController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new PaymentModel();

		if(!isset($_SESSION['po_userses']['p_register_user']) || $_SESSION['po_userses']['p_register_user'] == ''):
			$_SESSION['po_userses']['login_error'] = '<h4>Fill this form </h4><p>Please fill this form first to register account.</p>';
			$_SESSION['po_userses']['login_error_cls'] = "callout-danger";
			header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."register/");
			exit;
		endif;
		
		if(isset($_POST['selected_package'])):
			header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."payment/".$_POST['selected_package']);
			exit;
		endif;

		$this -> validplan = $this -> checkifplanvalid($_REQUEST['workid']);
		
		if(empty($this -> validplan)):
			$_SESSION['po_userses']['login_error'] = '<h4>Invalid Package</h4><p>Please select your plan again.</p>';
			$_SESSION['po_userses']['login_error_cls'] = "callout-danger";
			header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."plans/");
			exit;
		else:

			if($this -> validplan['plan_price'] == '0.00'):
				$this -> adduserplandetails($this -> validplan, $_SESSION['po_userses']['p_register_user']);
				$this -> updateuserplandetails($this -> validplan, $_SESSION['po_userses']['p_register_user']);
				unset($_SESSION['po_userses']['p_register_user']);
				$_SESSION['po_userses']['login_error'] = '<h4>Successfully registered</h4><p>Your account is activated successfully.</p>';
				$_SESSION['po_userses']['login_error_cls'] = "callout-info";
				header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."login/");
				exit;
			else:
				//code
			endif;

			if(isset($_POST['pay_card_number']) && $_POST['pay_card_number'] != ''):
				$cardnumber = $_POST['pay_card_number'];
				$cardname = $_POST['pay_nm_on_card'];
				$carddate = $_POST['pay_month'].$_POST['pay_year'];
				$cardcvv = $_POST['pay_cvv'];
				$cardtype = $_POST['pay_card_type'];
				$price = $this -> validplan['plan_price'];
				$this -> pay_result = $this -> dodirectpaypalpayment($cardtype, $cardnumber, $cardname, $carddate, $cardcvv, $price);
				if($this -> pay_result['ACK'] == 'Success' && $this -> pay_result['TRANSACTIONID'] != ''):
					$this -> adduserplandetails($this -> validplan, $_SESSION['po_userses']['p_register_user']);
					$this -> updateuserplandetails($this -> validplan, $_SESSION['po_userses']['p_register_user']);
					$this -> insertpaymentinfo($_SESSION['po_userses']['p_register_user'], $this -> validplan['id'], $this -> pay_result['TRANSACTIONID'], $this -> validplan['plan_price']);
					unset($_SESSION['po_userses']['p_register_user']);
					$_SESSION['po_userses']['login_error'] = '<h4>Successfully registered</h4><p>Check your email to activate your account.</p>';
					$_SESSION['po_userses']['login_error_cls'] = "callout-info";
					header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."login/");
					exit;
				else:
					$_SESSION['po_userses']['login_error'] = '<h4>Failed</h4><p>Transaction failed, please re-insert valid card details.</p>';
					$_SESSION['po_userses']['login_error_cls'] = "callout-danger";
					header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."payment/".$_REQUEST['workid']);
					exit;
				endif;
			endif;

		endif;
	}
	
	function checkifplanvalid($planid){
		$qry = "SELECT * FROM tbl_plans WHERE id = '".clear_input($planid)."' AND status = 1 LIMIT 1";
		return $result = $this->modelObj->fetchRow($qry);
	}
	function getreguserdetail($userid){
		$qry = "SELECT * FROM tbl_users WHERE id = '".clear_input($userid)."' AND status = 0 LIMIT 1";
		return $result = $this->modelObj->fetchRow($qry);
	}
	function adduserplandetails($plandetail, $userid){
		$startdate = date("Y-m-d");
		$enddate = date('Y-m-d', strtotime("+".$plandetail['month']." months", strtotime($startdate)));
		$qry = "INSERT INTO tbl_user_plan (plan_id, user_id, start_date, end_date, paid_amount, cr_date, status) values('".clear_input($plandetail['id'])."', '".clear_input($userid)."', '".clear_input($startdate)."', '".clear_input($enddate)."', '".clear_input($plandetail['plan_price'])."', NOW(), 1)";
		return $result = $this->modelObj->runQuery($qry);
	}
	function updateuserplandetails($plandetail, $userid){
		$qry = "UPDATE tbl_users SET plan_id = '".clear_input($plandetail['id'])."', image_limit = '".clear_input($plandetail['image_limit'])."', status = 0 WHERE id = '".clear_input($userid)."' AND status = 2";
		$result = $this->modelObj->runQuery($qry);

		$getreguserdetail = $this -> getreguserdetail($userid);
		$to=$getreguserdetail['emailid'];

		// subject
		$subject = 'ProjectOne - Registration successfully completed';

		// message
		$message = '<p>Hello</p>
		<p>Click on below link to active your ProjectOne account</p>
		<p><a href="'.$_SESSION['FRNT_DOMAIN_NAME'].'index.php?pid=login&acticod='.base64_encode($getreguserdetail['ref_id']).'">Click Here..</a></p>';

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
	function insertpaymentinfo($userid, $planid, $transactionid, $amount){
		$qry = "INSERT INTO `tbl_payment`(`user_id`, `plan_id`, `transaction_id`, `amount`, `cr_date`, `status`) VALUES ('".clear_input($userid)."','".clear_input($planid)."','".clear_input($transactionid)."','".clear_input($amount)."',NOW(),1)";
		return $result = $this->modelObj->runQuery($qry);
	}
	function dodirectpaypalpayment($cardtype, $cardnumber, $cardname, $carddate, $cardcvv, $price){
		//echo $cardnumber."---".$cardname."---".$carddate."---".$cardcvv."---".$price;

		$request_params = array
                    (
                    'METHOD' => 'DoDirectPayment', 
                    'USER' => $this -> api_username, 
                    'PWD' => $this -> api_password, 
                    'SIGNATURE' => $this -> api_signature, 
                    'VERSION' => $this -> api_version, 
                    'PAYMENTACTION' => 'Sale',                   
                    'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
                    'CREDITCARDTYPE' => $cardtype, 
                    'ACCT' => $cardnumber,                        
                    'EXPDATE' => $carddate,           
                    'CVV2' => $cardcvv, 
                    'FIRSTNAME' => $cardname, 
                    /*'LASTNAME' => 'Buyer',*/ 
                    'STREET' => '707 W. Bay Drive', 
                    'CITY' => 'Largo', 
                    'STATE' => 'FL',                     
                    'COUNTRYCODE' => 'US', 
                    'ZIP' => '33770', 
                    'AMT' => $price, 
                    'CURRENCYCODE' => 'USD', 
                    'DESC' => 'Testing Payments Pro'
                    );

		// Loop through $request_params array to generate the NVP string.
		$nvp_string = '';
		foreach($request_params as $var=>$val)
		{
		    $nvp_string .= '&'.$var.'='.urlencode($val);    
		}

		// Send NVP string to PayPal and store response
		$curl = curl_init();
		        curl_setopt($curl, CURLOPT_VERBOSE, 1);
		        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		        curl_setopt($curl, CURLOPT_URL, $this -> api_endpoint);
		        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);
		 
		$result = curl_exec($curl);     
		curl_close($curl);

		$resultarray = $this -> NVPToArray($result);
		return $resultarray;
	}
}
?>