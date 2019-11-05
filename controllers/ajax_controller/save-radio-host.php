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
?><?php 

$data = json_decode($_POST['timeline'], true);
$data = implode(",",$data);
if(!empty($data)){
	$uid = $_SESSION['po_userses']['flc_usrlogin_id'];
	$qry="SELECT * FROM  tbl_radio_host where `user_id` =$uid";
	$result = $modelObj->fetchRows($qry);
	if($result == 00){
		$qrySave="INSERT INTO tbl_radio_host (`user_id`, `timeline`) VALUES('".$uid."', '".$data."') ";
	}else{
		$qrySave="UPDATE tbl_radio_host SET `timeline` = '".$data."' WHERE `user_id` = $uid";
	}
	$result = $modelObj->runQuery($qrySave); 
}


?>