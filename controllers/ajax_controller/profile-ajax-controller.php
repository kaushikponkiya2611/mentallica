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
?>
<?php
if(isset($_POST['getCollegeListChk']) && $_POST['getCollegeListChk'] != ''):
  $uni_list = $commoncont -> getCollegeListByUniversity($_POST['uni_id']);	
  ?><option value="">Select College</option><?php		
  foreach ($uni_list as $k => $unilist):?>
    <option value="<?php echo $unilist['id'];?>"><?php echo $unilist['col_name'];?></option>
  <?php endforeach;
endif;


if(isset($_POST['action']) && $_POST['action']=='generateOTP'){
    $user_email = $_SESSION['po_userses']['flc_usrlogin_email'];
    $current_user_id = $_SESSION['po_userses']['flc_usrlogin_id'];
    $headers = 'MIME-Version: 1.0' . "\r\n";
    //$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\n";
    // Additional headers
    $headers .= 'From: ProjectOne <ajshnr@gmail.com>' . "\r\n";
    $subject = "Wallet OTP";
    // Mail it
    $otp = rand("000000", "999999");
    $message = "Your wallet OTP is: <strong>". $otp."</strong>";
    
    $qry = "UPDATE tbl_users SET email_top = '" . $otp . "' WHERE id = '" . $current_user_id . "' ";
    $result = $modelObj->runQuery($qry);
    $_SESSION['wallet_otp'] = $otp;
    //@mail($user_email, $subject, $message, $headers);
    die;
}

if(isset($_POST['action']) && $_POST['action']=='checkOTP'){
    $otp = $_POST['otp'];
    $current_user_id = $_SESSION['po_userses']['flc_usrlogin_id'];
    $qry = "SELECT email_top from tbl_users WHERE id='".$current_user_id."'";
    $result = $modelObj->fetchRows($qry);
    if(isset($result[0]['email_top']) && $result[0]['email_top']!='' && $result[0]['email_top']!=0){
        if($result[0]['email_top'] == $otp){
            $msg = "success";
            $_SESSION['otp'] = $otp;
            $qry1 = "UPDATE tbl_users SET email_top = '0' WHERE id = '" . $current_user_id . "' ";
            $modelObj->runQuery($qry1);
        }else{
            $msg = "OTP is invalid or expired!";
        }
    }else{
        $msg = "OTP is invalid or expired!";
    }
    echo $msg;
    die;
}
?>