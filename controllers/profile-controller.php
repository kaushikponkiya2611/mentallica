<?php
class ProfileController extends CommonController
{
	function __construct()
	{
		/*  */
		parent::__construct();
		$this -> modelObj = new ProfileModel();
/* echo "<pre/>"; print_r($_REQUEST); die; */
		$this -> userdetail = $this -> profileinfo();
		$this -> paidplans = $this -> getpaidplan();
		$this -> gtcategory = $this -> getcategorylist();

		if(isset($_POST['btn_presonal_info']) && $_POST['txt_firstname'] != '' && count($_POST) > 0):
            $assigned_artist = '';
        
            if(isset($_POST['txt_assign_artist']) ){
               $assigned_artist = implode(",", $_POST['txt_assign_artist']);
            }
			$usr_update = $this -> updateuserdetails($_POST['txt_firstname'], $_POST['txt_lastname'], $_POST['txt_mobileno'], $_POST['u_r_gender'], $_POST['u_r_country'], $_POST['u_r_state'], $_POST['u_r_city'], $_POST['u_r_address'],$assigned_artist);
			$upload_dir =$_SESSION['SITE_IMG_PATH']."artist/";
			$upload_dirthumb =$_SESSION['SITE_IMG_PATH']."artist/thumb/";
			if(!dir($upload_dir))
			{
				mkdir($upload_dir);
			}
			if(!dir($upload_dirthumb))
			{
				mkdir($upload_dirthumb);
			}
			if(isset($_FILES["file_profile_pic"]["tmp_name"]))
			{
				$tmpfile = $_FILES["file_profile_pic"]["tmp_name"];
				$newname = $_FILES["file_profile_pic"]["name"];				
				$insertimage="";
				if($_FILES["file_profile_pic"]["tmp_name"] != '')
				{
					$abc=date("dmyHis");
					$insertimage=$abc.$newname;
					if(move_uploaded_file($tmpfile, $upload_dir.$insertimage))
					{
					  	$resizeObj_20 = new resize($upload_dir.$insertimage); 
					  	$resizeObj_20 -> resizeImage(50, 50, 'exact');
					  	$resizeObj_20 -> saveImage($upload_dirthumb.$insertimage,$upload_dir.$insertimage, 100);

					  	$usr_update_img = $this -> updateuserprofilepic($insertimage);
					  	$userthumb =$_SESSION['SITE_IMG_PATH']."artist/thumb/".$insertimage;
						if($insertimage != '' && is_file($userthumb)):
							$_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME']."upload/artist/thumb/".$insertimage;
						else:
							$_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME']."upload/artist/default_profile_pic.jpg";
						endif;
					}
				}
			}
			$_SESSION['po_userses']['login_error'] = '<h4>Successfully updated</h4><p>Your profile updated successfully.</p>';
			$_SESSION['po_userses']['login_error_cls'] = "callout-info";
			header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."profile/");
			exit;
		endif;

		if(isset($_POST['txt_current_password']) && $_POST['txt_current_password'] != '' && isset($_POST['txt_new_password']) && $_POST['txt_new_password'] != ''){
			$this -> isvalidpwd = $this -> checkcurrentpassword($_POST['txt_current_password']);
			if($this -> isvalidpwd <= 0){
				$_SESSION['po_userses']['login_error'] = '<h4>Invalid Password</h4><p>Please re-enter your current password.</p>';
				$_SESSION['po_userses']['login_error_cls'] = "callout-danger";
			}elseif($_POST['txt_new_password'] != $_POST['txt_conf_password']){
				$_SESSION['po_userses']['login_error'] = '<h4>Password Unmatched</h4><p>Please enter same password in New Password and Confirm Passowrd fields.</p>';
				$_SESSION['po_userses']['login_error_cls'] = "callout-danger";
			}else{
				$this -> updateuserpassword($_POST['txt_new_password']);
				$_SESSION['po_userses']['login_error'] = '<h4>Successfully updated</h4><p>Your password is successfully updated.</p>';
				$_SESSION['po_userses']['login_error_cls'] = "callout-info";
				header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."profile");
				exit;
			}
		}

		if(isset($_POST['selected_package']) && $_POST['selected_package'] != '' && count($_POST) > 0):
			$this -> validplan = $this -> getplandetails($_POST['selected_package']);
			if(isset($_POST['pay_card_number']) && $_POST['pay_card_number'] != ''):
				$cardnumber = $_POST['pay_card_number'];
				$cardname = $_POST['pay_nm_on_card'];
				$carddate = $_POST['pay_month'].$_POST['pay_year'];
				$cardcvv = $_POST['pay_cvv'];
				$cardtype = $_POST['pay_card_type'];
				$price = $this -> validplan['plan_price'];
				$this -> pay_result = $this -> dodirectpaypalpayment($cardtype, $cardnumber, $cardname, $carddate, $cardcvv, $price);
				if($this -> pay_result['ACK'] == 'Success' && $this -> pay_result['TRANSACTIONID'] != ''):
					$this -> adduserplandetails($this -> validplan, $_SESSION['po_userses']['flc_usrlogin_id']);
					$this -> updateuserplandetails($this -> validplan, $_SESSION['po_userses']['flc_usrlogin_id']);
					$this -> insertpaymentinfo($_SESSION['po_userses']['flc_usrlogin_id'], $this -> validplan['id'], $this -> pay_result['TRANSACTIONID'], $this -> validplan['plan_price']);
					$_SESSION['po_userses']['flc_usrlogin_plan'] = $this -> validplan['id'];
					//unset($_SESSION['po_userses']['p_register_user']);
					$_SESSION['po_userses']['login_error'] = '<h4>Successfully upgraded</h4><p>Your package is successfully upgraded.</p>';
					$_SESSION['po_userses']['login_error_cls'] = "callout-info";
					header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."profile");
					exit;
				else:
					$_SESSION['po_userses']['login_error'] = '<h4>Failed</h4><p>Transaction failed, please re-insert valid card details.</p>';
					$_SESSION['po_userses']['login_error_cls'] = "callout-danger";
					header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."profile");
					exit;
				endif;
			endif;
			
			header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."profile/");
			exit;
		endif;

		if(isset($_POST['sel_category_list']) && !empty($_POST['sel_category_list']) && count($_POST) > 0):

				$previewcat = implode(",", $_POST['sel_category_list']);
				$this -> savepreviewsetting = $this -> updateuserpreviewcategorylist($previewcat);
				
			header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."profile/");
			exit;
		endif;
		
		if(isset($_POST['btn_payment_setting'])):
$qry = "UPDATE tbl_users SET paypal_email_show='".clear_input($_POST['txt_paypalemailshow'])."', paypal_email_id='".clear_input($_POST['txt_paypalemailid'])."' WHERE id = ".$_SESSION['po_userses']['flc_usrlogin_id'];
		 $result = $this->modelObj->runQuery($qry);
				
			header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."profile/");
			exit;
		endif;
	}
	
	function profileinfo(){
        $qry="SELECT * FROM tbl_users WHERE status = 1 AND id = ".$_SESSION['po_userses']['flc_usrlogin_id'];
        return $result = $this->modelObj->fetchRow($qry);
	}
	function getplandetails($planid){
		$qry = "SELECT * FROM tbl_plans WHERE id = '".clear_input($planid)."' AND status = 1 LIMIT 1";
		return $result = $this->modelObj->fetchRow($qry);
	}
	function updateuserdetails($firstname, $lastname, $mobileno, $gender, $country, $state, $city, $address,$assigned_artist){
		$qrylatilong = "SELECT * FROM cities WHERE id=".$city;
		$resultlatilongi = $this->modelObj->fetchRow($qrylatilong);
		
		$qry = "UPDATE tbl_users SET first_name='".clear_input($firstname)."', last_name='".clear_input($lastname)."', mobileno='".clear_input($mobileno)."', gender='".clear_input($gender)."', country='".clear_input($country)."', state='".clear_input($state)."', city='".clear_input($city)."',  latitude='".clear_input($resultlatilongi['latitude'])."',  longitude='".clear_input($resultlatilongi['longitude'])."', address='".clear_input($address)."',cmpny_assigned_artists='".clear_input($assigned_artist)."' WHERE id = ".$_SESSION['po_userses']['flc_usrlogin_id'];
        return $result = $this->modelObj->runQuery($qry);
	}
	function updateuserprofilepic($imgname){
		$qry="UPDATE  tbl_users SET image='".$imgname."' where id=".$_SESSION['po_userses']['flc_usrlogin_id'];
		return $result = $this->modelObj->runQuery($qry);
	}
	function updateuserpreviewcategorylist($previewcat){
		$qry = "UPDATE tbl_users SET preview_category = '".clear_input($previewcat)."' WHERE id = '".$_SESSION['po_userses']['flc_usrlogin_id']."' AND status = 1";
		return $result = $this->modelObj->runQuery($qry);
	}

	function getpaidplan(){
		$qry="SELECT * FROM tbl_plans WHERE status = 1 AND plan_price != '0.00' ";
      	return $result = $this->modelObj->fetchRows($qry);
	}
	function adduserplandetails($plandetail, $userid){
		$startdate = date("Y-m-d");
		$enddate = date('Y-m-d', strtotime("+".$plandetail['month']." months", strtotime($startdate)));
		$qry = "INSERT INTO tbl_user_plan (plan_id, user_id, start_date, end_date, paid_amount, cr_date, status) values('".clear_input($plandetail['id'])."', '".clear_input($userid)."', '".clear_input($startdate)."', '".clear_input($enddate)."', '".clear_input($plandetail['plan_price'])."', NOW(), 1)";
		return $result = $this->modelObj->runQuery($qry);
	}
	function updateuserplandetails($plandetail, $userid){
		$qry = "UPDATE tbl_users SET plan_id = '".clear_input($plandetail['id'])."', image_limit = '".clear_input($plandetail['image_limit'])."', status = 1 WHERE id = '".clear_input($userid)."' AND status = 1";
		return $result = $this->modelObj->runQuery($qry);
	}
	function insertpaymentinfo($userid, $planid, $transactionid, $amount){
		$qry = "INSERT INTO `tbl_payment`(`user_id`, `plan_id`, `transaction_id`, `amount`, `cr_date`, `status`) VALUES ('".clear_input($userid)."','".clear_input($planid)."','".clear_input($transactionid)."','".clear_input($amount)."',NOW(),1)";
		return $result = $this->modelObj->runQuery($qry);
	}
	function checkcurrentpassword($pwd){
	  $qry="SELECT * FROM tbl_users WHERE status = 1 AND password = '".clear_input(md5($pwd))."' AND id = ".$_SESSION['po_userses']['flc_usrlogin_id'];
      return $result = $this->modelObj->numRows($qry);
	}
	function updateuserpassword($newpassword){
		$qry = "UPDATE tbl_users SET password='".clear_input(md5($newpassword))."' WHERE id = ".$_SESSION['po_userses']['flc_usrlogin_id'];
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
    function getArtists(){
		  $qry="SELECT * FROM tbl_users where status!=2 and usertype=1 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
    
}
?>