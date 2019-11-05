<?php 
	@session_start();
	include('../../models/db.php');
	include('../../models/common-model.php');
	include('../../includes/thumb_new.php');
	include('../../includes/resize-class.php');
	include('../common-controller.php');
	$database = new Connection();
	include('../../models/ajax-model.php');
	$modelObj = new AjaxModel();
	
	$controller_class = new CommonController();
	
	$upload_dir =$_SERVER['SITE_IMG_PATH']."upload/image/";
	$upload_dirthumb =$_SERVER['SITE_IMG_PATH']."upload/image/thumb/";

?>
<?php	
	
if(isset($_POST['forgot_password_function_chk']) && $_POST['forgot_password_function_chk'] != ''){

		$qry = "SELECT * From admin WHERE email = '".$_POST['emailid']."'";
		$result = $modelObj->fetchRow($qry);
		
	if($result !='')
	{
		$datetime=date("dymHis");
		$to = $_POST['emailid'];
		$subject = 'Reset Password Hoteljobs Admin';
		
		$headers  = "From: suport@hoteljobs.com \r\n";
		$headers .= "Reply-To: suport@hoteljobs.com \r\n";
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
<td height="73" style="background:#326ca8; padding-left:20px;"><a href="'.$_SESSION['ADMIN_DOMAIN_NAME'].'"><img src="'.$_SESSION['ADMIN_DOMAIN_NAME'].'images/logo.png" border="0" alt="" style="display:block;"/></a></td>        
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
<td height="30" style="font-size:14px; color:#4d4d4d; font-family:Arial, Helvetica, sans-serif; padding:0px 20px;">You have requested to reset the password, your changed password is mentioned below: </td>
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
		<td width="20%"><strong>New Password : </strong></td>
		<td width="60%">'.$datetime.'</td>
		<td width="20%"><strong></strong></td>
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
		if($ismail)
		{
			$qry = "UPDATE `admin` SET `password` = '".md5($datetime)."'  WHERE `email` = '".$_POST['emailid']."'";
			$result = $modelObj->runQuery($qry);
			echo 1;
		}
		else
		{
			echo 0;
		}
	}else 
	{
		echo 2;
	}
		
}


if(isset($_POST['hid_sendmessage']) && $_POST['hid_sendmessage'] != ''){
	
 	 	$qry = "SELECT count(*) as totalrec FROM user WHERE status!=2 and email_id = '".$_POST['txt_sendmsgto']."'";
		$result = $modelObj -> fetchRow($qry);
	
	
	if($result['totalrec'] ==1)
	{
		if($_POST['txt_sendmsgto'] !=''){
			
			
			$to =$_POST['txt_sendmsgto'];

			$subject = 'Message From Hoteljobs';

			$headers  = "From: support@hoteljobs.com \r\n";

			$headers .= "Reply-To: ".$_POST['contactus_email']." \r\n";

			$headers .= "MIME-Version: 1.0\r\n";

			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				

			$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
.ExternalClass {
	display:block !important;
}
body {
	font-family:Calibri;
	color:#333333;
	font-size:15px;
}
</style>
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" bgcolor="#ffffff">
<table style="width: 100%;" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
<tbody>
  <tr>
    <td><table style="width: 600px;" align="center" border="0"cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="600" style="border:1px solid #333333;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="73" style="background:#D3D3D3; padding-left:20px;"><a href="'.$_SESSION['FRNT_DOMAIN_NAME'].'">
				  <img src="'.$_SESSION['ADMIN_DOMAIN_NAME'].'images/logo.png" border="0" alt="" style="display:block;"/></a></td>
                </tr>
                <tr>
                  <td height="21" style="background:#000000;"></td>
                </tr>
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td style="font-size:24px; font-weight:bold; color:#000000; font-family:Calibri; padding:0px 20px;"><strong>Message Detail From Hoteljobs</strong> </td>
                </tr>
                <tr>
                  <td height="30" style="font-size:15px; color:#4d4d4d; font-family:Calibri; padding:0px 20px;">Detail of Message is mentioned below: </td>
                </tr>
                <tr>
                  <td height="20"></td>
                </tr>
                <tr>
                  <td style="font-size:15px; color:#000000; font-family:Arial; padding:0px 20px;">&nbsp;</td>
                </tr>
                <tr>
                  <td style="font-size:13px; color:#4d4d4d; font-family:Arial; padding:0px 20px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%"><strong>By : </strong></td>
                        <td width="78%">Administrator</td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Subject : </strong></td>
                        <td width="78%">'.$_POST['txt_sendmsgsub'].'</td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Message : </strong></td>
                        <td width="78%">'.$_POST['txt_sendmsgdes'].'</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="45"></td>
                </tr>
              </table></td>
        </tbody>
      </table>
</body>
</html>
';

		$ismail=mail($to, $subject, $message, $headers);
		echo 1;
   }
   else
   {
	 echo 0;
   }
   
   }else {
   
   echo 2;
   
   }
}
?>

<?php
if(isset($_POST['hid_sendmessageemployers']) && $_POST['hid_sendmessageemployers'] != ''){
	
	
	
		
		
			/*$userlist=$controller_class->getCompanyByIds();
			$i=0;
			if($userlist !='') {  
			foreach($userlist as $k=>$val)
			{

			$to =$val['email_id'];
			$subject = 'Message From Hoteljobs';
			$headers  = "From: support@hoteljobs.com \r\n";

			$headers .= "Reply-To: ".$_POST['contactus_email']." \r\n";

			$headers .= "MIME-Version: 1.0\r\n";

			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				

			$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
.ExternalClass {
	display:block !important;
}
body {
	font-family:Calibri;
	color:#333333;
	font-size:15px;
}
</style>
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" bgcolor="#ffffff">
<table style="width: 100%;" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
<tbody>
  <tr>
    <td><table style="width: 600px;" align="center" border="0"cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="600" style="border:1px solid #333333;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="73" style="background:#D3D3D3; padding-left:20px;"><a href="'.$_SESSION['FRNT_DOMAIN_NAME'].'">
				  <img src="'.$_SESSION['ADMIN_DOMAIN_NAME'].'images/logo.png" border="0" alt="" style="display:block;"/></a></td>
                </tr>
                <tr>
                  <td height="21" style="background:#000000;"></td>
                </tr>
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td style="font-size:24px; font-weight:bold; color:#000000; font-family:Calibri; padding:0px 20px;"><strong>Message Detail From Hoteljobs</strong> </td>
                </tr>
                <tr>
                  <td height="30" style="font-size:15px; color:#4d4d4d; font-family:Calibri; padding:0px 20px;">Detail of Message is mentioned below: </td>
                </tr>
                <tr>
                  <td height="20"></td>
                </tr>
                <tr>
                  <td style="font-size:15px; color:#000000; font-family:Arial; padding:0px 20px;">&nbsp;</td>
                </tr>
                <tr>
                  <td style="font-size:13px; color:#4d4d4d; font-family:Arial; padding:0px 20px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%"><strong>By : </strong></td>
                        <td width="78%">Administrator</td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Subject : </strong></td>
                        <td width="78%">'.$_POST['txt_sendmsgsub'].'</td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Message : </strong></td>
                        <td width="78%">'.$_POST['txt_sendmsgdes'].'</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="45"></td>
                </tr>
              </table></td>
        </tbody>
      </table>
</body>
</html>
';

			$ismail=mail($to, $subject, $message, $headers);
			$i++;
			}
			echo "1";
			}else {
			
			}*/
		
}
?>

<?php
if(isset($_POST['hid_sendmessagejobseekers']) && $_POST['hid_sendmessagejobseekers'] != ''){
	
	
		
		/*	$userlist=$controller_class->getjobseekers();
			$i=0;
			if($userlist !='') { 
			foreach($userlist as $k=>$val)
			{
			$to =$val['email_id'];

			$subject = 'Message From Hoteljobs';

			

			$headers  = "From: support@hoteljobs.com \r\n";

			$headers .= "Reply-To: ".$_POST['contactus_email']." \r\n";

			$headers .= "MIME-Version: 1.0\r\n";

			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				

			$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
.ExternalClass {
	display:block !important;
}
body {
	font-family:Calibri;
	color:#333333;
	font-size:15px;
}
</style>
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" bgcolor="#ffffff">
<table style="width: 100%;" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
<tbody>
  <tr>
    <td><table style="width: 600px;" align="center" border="0"cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="600" style="border:1px solid #333333;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="73" style="background:#D3D3D3; padding-left:20px;"><a href="'.$_SESSION['FRNT_DOMAIN_NAME'].'">
				  <img src="'.$_SESSION['ADMIN_DOMAIN_NAME'].'images/logo.png" border="0" alt="" style="display:block;"/></a></td>
                </tr>
                <tr>
                  <td height="21" style="background:#000000;"></td>
                </tr>
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td style="font-size:24px; font-weight:bold; color:#000000; font-family:Calibri; padding:0px 20px;"><strong>Message Detail From Hoteljobs</strong> </td>
                </tr>
                <tr>
                  <td height="30" style="font-size:15px; color:#4d4d4d; font-family:Calibri; padding:0px 20px;">Detail of Message is mentioned below: </td>
                </tr>
                <tr>
                  <td height="20"></td>
                </tr>
                <tr>
                  <td style="font-size:15px; color:#000000; font-family:Arial; padding:0px 20px;">&nbsp;</td>
                </tr>
                <tr>
                  <td style="font-size:13px; color:#4d4d4d; font-family:Arial; padding:0px 20px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%"><strong>By : </strong></td>
                        <td width="78%">Administrator</td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Subject : </strong></td>
                        <td width="78%">'.$_POST['txt_sendmsgsub'].'</td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Message : </strong></td>
                        <td width="78%">'.$_POST['txt_sendmsgdes'].'</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="45"></td>
                </tr>
              </table></td>
        </tbody>
      </table>
</body>
</html>
';

			$ismail=mail($to, $subject, $message, $headers);
			$i++;
			}
			echo "1";
			} else
		   {
			 echo "0";
		   }	
		*/
   
  
}
?>
