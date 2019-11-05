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
$myfiles = json_decode($_POST['myfiles'], true);


if(!empty($data)){
	foreach($data as $value){
		/* $filenameStr = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value['content']); */
		$string = str_replace('.', '', $value['content']);
		
		if (in_array($string, $myfiles)) {
			$uid = $_SESSION['po_userses']['flc_usrlogin_id'];
			$start = clear_input($value['start']);
			$end = clear_input($value['end']);
			$file = clear_input($value['content']);
			
			
			$uid = $_SESSION['po_userses']['flc_usrlogin_id'];
			$qry="SELECT * FROM radio_timeline where uid =$uid AND content = '$file' AND start = '$start' AND end = '$end' ";
			$result = $modelObj->fetchRows($qry);
			if($result == 00){
				$qry="INSERT INTO  radio_timeline (`uid`, `content`, `start`, `end`) VALUES('".$uid."', '".$file."', '".$start."', '".$end."') ";
				$result = $modelObj->runQuery($qry); 
			}
		}
		
	}
}


?>