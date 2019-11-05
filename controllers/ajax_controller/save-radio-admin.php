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

$data = $_POST['timeline'];
$qry="INSERT INTO  radio_timeline_final (`timeline`) VALUES('$data') ";
$result = $modelObj->runQuery($qry); 




?>