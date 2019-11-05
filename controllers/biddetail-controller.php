<?php
class BiddetailController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new BiddetailModel();
		
		$this -> _allbibs1 = $this -> _allbibs();
	}
	
	function _allbibs(){
		$stringd = $_SERVER['REQUEST_URI'];
		$stringdArg =  explode("=",$stringd);
		$imgID = $stringdArg[1];
		if(!empty($imgID)){
			$qry1="SELECT tbl_notification.*,tbl_users.username FROM tbl_notification LEFT JOIN tbl_users on tbl_notification.requesteduser = tbl_users.id WHERE  tbl_notification.userid='".$_SESSION['po_userses']['flc_usrlogin_id']."' AND tbl_notification.objectid  = $imgID ORDER BY price DESC";
			$result1 = $this->modelObj->fetchRows($qry1);
			return $result1;
		}
		
		
	}
	

	

}
?>