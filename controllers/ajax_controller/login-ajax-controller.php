<?php 
@session_start();
error_reporting(0);
include('../../models/db.php');
include('../../models/common-model.php');
include('../../includes/thumb_new.php');
include('../../includes/resize-class.php');
include('../common-controller.php');
$database = new Connection();
include('../../models/ajax-model.php');
$modelObj = new AjaxModel();
$commoncont = new CommonController();

if(isset($_POST['h_login']) && $_POST['h_login'] != ''){				
	$qry = "SELECT *,count(*) as totalrecord FROM tbl_signup WHERE (username = '".mysql_real_escape_string(trim($_POST['txt_loginusername']))."' or emailid = '".mysql_real_escape_string(trim($_POST['txt_loginusername']))."') and password = '".mysql_real_escape_string(trim(md5($_POST['txt_loginpassword'])))."' and status=1";
	$result = $modelObj -> fetchRow($qry);
	if($result['totalrecord']==1){
		$_SESSION['yala']['yala_userid'] = $result['id']; 
		$_SESSION['yala']['yala_password'] = $result['password']; 
		$_SESSION['yala']['yala_refid'] = $result['ref_id']; 
		$_SESSION['yala']['yala_fullname'] = $result['fullname'];
		$_SESSION['yala']['yala_userplan'] = $result['planId'];
		$_SESSION['yala']['yala_country'] = $result['country'];
		$_SESSION['yala']['yala_region'] = $result['region'];
		$_SESSION['yala']['yala_city'] = $result['city'];
		/*if(isset($_POST['login_check']) && $_POST['login_check']==1)
		{
			$name=$_POST['txt_loginusername'];
			setcookie("yala_username", $name,time()+3600);
			$pswd=$_POST['txt_loginpassword'];
			setcookie("yala_password",$pswd,time()+3600);
		}
		else
		{
			setcookie("yala_username", "", time()-3600);
			setcookie("yala_password", "", time()-3600);
		}*/
		//echo $_COOKIE['followgh_username'];
		//header('location: index.php?pid=home');
		
		$update="update tbl_signup set last_login=NOW() where id='".$result['id']."'";
		$result_update = $modelObj -> runQuery($update);
		echo 1;
		//print_r($_COOKIE);
	}else{
		echo 0;
	}
	
}

if(isset($_POST['h_signup']) && $_POST['h_signup'] != ''){				
	$qry1 = "SELECT count(*) as totalrecord1 FROM tbl_signup WHERE username = '".mysql_real_escape_string(trim($_POST['txt_signupusername']))."' and status!=2";
	$result1 = $modelObj -> fetchRow($qry1);
	
	$qry2 = "SELECT count(*) as totalrecord2 FROM tbl_signup WHERE emailid = '".mysql_real_escape_string(trim($_POST['txt_signupemailid']))."' and status!=2";
	$result2 = $modelObj -> fetchRow($qry2);
	
	if($result1['totalrecord1']>0){
		echo "2";
	}else if($result2['totalrecord2']>0){
		echo "3";
	}else{
		if($_POST['txt_signupplanid']=='1'){
			$userstatus=0;
		}else{
			$userstatus=1;
		}
		
		$qry_insert="insert into tbl_signup (fullname,username,emailid,password,contactno,address,planId,planDate,cr_date,status) values ('".mysql_real_escape_string(trim($_POST['txt_signupfullname']))."','".mysql_real_escape_string(trim($_POST['txt_signupusername']))."','".mysql_real_escape_string(trim($_POST['txt_signupemailid']))."','".mysql_real_escape_string(trim(md5($_POST['txt_signuppassword'])))."','".mysql_real_escape_string(trim($_POST['txt_signupcnumb']))."','".mysql_real_escape_string(trim($_POST['txt_signupaddress']))."','".mysql_real_escape_string(trim($_POST['txt_signupplanid']))."',NOW(),NOW(),'".$userstatus."')";
		$result_insert=$modelObj -> runQuery($qry_insert);
		if($result_insert){
			$id=mysql_insert_id();
			$code="REG".date("dmYHis");
			
			
			
			if($_POST['txt_signupplanid']!='' && $_POST['txt_signupplanid']!='1')
			{
				$qry_pay="insert into tbl_payment (userId,planId,planPrc,bankName,accNumber,cardName,cardNumber,expireDate,cvv2Cvc2No,cr_date,status) values ('".$id."','".mysql_real_escape_string(trim($_POST['txt_signupplanid']))."','".mysql_real_escape_string(trim($_POST['txt_signupplanpr']))."','".mysql_real_escape_string(trim($_POST['bnk_name']))."','".mysql_real_escape_string(trim(md5($_POST['bnk_acc_no'])))."','".mysql_real_escape_string(trim($_POST['bnk_nm_crd']))."','".mysql_real_escape_string(trim($_POST['bnk_crd_no']))."','".mysql_real_escape_string(trim($_POST['expiry_date']))."','".mysql_real_escape_string(trim($_POST['cvv_cvc']))."',NOW(),1)";
				$result_pay=$modelObj -> runQuery($qry_pay);
				$pyid=mysql_insert_id();
			}
			
			$qry_update="update tbl_signup set ref_id='".$code."', paymentId='".$pyid."' where id='".$id."'";
			$result_update=$modelObj -> runQuery($qry_update);
			/*$to=$_POST['txt_signupemailid'];
			// subject
			$subject = 'Yala - Registration successfully completed';
			
			// message
			$message = '<p>Hello,'.$_POST['txt_signupfullname'].'</p>
			<p>Click on below link to active your Yala account.</p>
			<p><a href="'.$_SESSION['FRNT_DOMAIN_NAME'].'login/'.$code.'">Click Here..</a></p>';
			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// Additional headers
			$headers .= 'From: yala<info@yalash.com>' . "\r\n";
			// Mail it
			@mail($to, $subject, $message, $headers);*/
			//unset($_SESSION['security_code']);
			
			echo "1";
		}else{
			echo "0";
		}
	}		
}
if(isset($_POST['findregion']) && $_POST['findregion'] != ''){
	?>
	<select class="comboinp" name="txt_signupregion" id="txt_signupregion" style="width: 273px;color:#777676">
		<option value="">Select Region</option>
		<?php
		if($commoncont->regionmaster($_POST['countryid']) != ''){
			$i=0;
			foreach($commoncont->regionmaster($_POST['countryid']) as $k=>$region){
			?>
			<option value="<?=$region['id']?>"><?=$region['region']?></option>
			<?php
			}
		}
		?>
	</select>
	<?php
}
if(isset($_POST['findcity']) && $_POST['findcity'] != ''){
	?>
	<select class="comboinp" name="txt_signupcity" id="txt_signupcity" style="width: 273px;color:#777676">
		<option value="">Select City</option>
		<?php
		if($commoncont->citymaster($_POST['countryid'],$_POST['regionid']) != ''){
			$i=0;
			foreach($commoncont->citymaster($_POST['countryid'],$_POST['regionid']) as $k=>$city){
			?>
			<option value="<?=$city['id']?>"><?=$city['city']?></option>
			<?php
			}
		}
		?>
	</select>
	<?php
}
?>
<?php
if(isset($_POST['getPlan']) && $_POST['getPlan']!='')
{
	$qry="UPDATE tbl_signup SET planId='".$_POST['plid']."' WHERE id='".$_POST['rid']."'";
	$res=$modelObj -> runQuery($qry);
	if($res){echo 1;}else{echo 0;}
}
?>
<?php 
if(isset($_POST['verifyeu']) && $_POST['verifyeu']!='')
{
	$qry1 = "SELECT count(*) as totalrecord1 FROM tbl_signup WHERE username = '".mysql_real_escape_string(trim($_POST['userid']))."' and status!=2";
	$result1 = $modelObj -> fetchRow($qry1);
	
	$qry2 = "SELECT count(*) as totalrecord2 FROM tbl_signup WHERE emailid = '".mysql_real_escape_string(trim($_POST['emailid']))."' and status!=2";
	$result2 = $modelObj -> fetchRow($qry2);
	
	if($result1['totalrecord1']>0){
		echo "2";
	}else if($result2['totalrecord2']>0){
		echo "3";
	}else{
		echo "1";
	}
}
?>
<?php
if(isset($_POST['forgotPasswordEmailChk']) && $_POST['forgotPasswordEmailChk']!='')
{
	$qry_email="SELECT * FROM tbl_signup WHERE emailid='".$_POST['emailid']."'";
	$res_email = $modelObj -> fetchRow($qry_email);
	if($res_email!='')
	{
		$forId=base64_encode($res_email['id']);
		$to = $_POST['emailid'];
		//$to = 'nikjoshi96@gmail.com';
			
		$subject = 'Reset Password YALASHEEL';
		
		$headers  = "From: suport@yala.com \r\n";
		$headers .= "Reply-To: suport@yalasheel.com \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
.ExternalClass{display:block !important;}
body {font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:14px;}
</style>
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" bgcolor="#ffffff">
<table style="width: 100%;" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td>


<table style="width: 600px;" align="center" border="0"cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td width="600" style="border:1px solid #333333;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>      	
<td height="73" style="background:#326ca8; padding-left:20px;"><a href="'.$_SESSION['FRNT_DOMAIN_NAME'].'"><img src="'.$_SESSION['FRNT_DOMAIN_NAME'].'images/logo_06.png" border="0" alt="" style="display:block;"/></a></td>        
</tr>       
<tr>
<td height="21" style="background:#003300;"></td>
</tr>
<tr>
<td height="10"></td>
</tr>
<tr>
<td style="font-size:24px; font-weight:bold; color:#2F8807; font-family:Arial, Helvetica, sans-serif; padding:0px 20px;"><strong>Reset Password</strong> </td>
</tr>

<tr>
<td height="30" style="font-size:14px; color:#4d4d4d; font-family:Arial, Helvetica, sans-serif; padding:0px 20px;">To initiate the password reset process for your  account click the link below: </td>
</tr>
<tr>
<td height="20"></td>
</tr>

<tr>
<td style="font-size:14px; color:#000000; font-family:Arial; padding:0px 20px;">&nbsp;</td>
</tr>
<tr>
<td style="font-size:13px; color:#4d4d4d; font-family:Arial; padding:0px 20px;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="5"><strong></strong></td>
		<td width="13%"><a style="cursor:pointer;" href="'.$_SESSION['FRNT_DOMAIN_NAME'].'index.php?pid=home&forgot_emp_key='.$forId.'">Click Here To Reset Your Password</a></td>
		<td width="78%"><strong></strong></td>
	  </tr>
	</table>        </td>
</tr>

<tr>
<td height="45"></td>
</tr>      
   
</table>
</td>
</tbody>
</table>

</body>
</html>';
		$ismail=mail($to, $subject, $message, $headers);
		if($ismail){ echo 1;}else{ echo 0;}
	}
	else
	{
		echo 3;
	}
}
?>
<?php
if(isset($_POST['resetPasswordEmailChk']) && $_POST['resetPasswordEmailChk']!='')
{
	$qry_email="SELECT * FROM tbl_signup WHERE id='".base64_decode($_POST['useriid'])."'";
	$res_email = $modelObj -> fetchRow($qry_email);
	
	if($res_email!=''){
		$c_pass="UPDATE tbl_signup SET password='".md5($_POST['rpassword'])."'";
		$c_res=$modelObj -> runQuery($c_pass);
		if($c_res){echo 1;}else{echo 0;}
	}else
	{
		echo 0;
	}
	
}
?>