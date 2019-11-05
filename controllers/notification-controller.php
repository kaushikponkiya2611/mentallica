<?php
class NotificationController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new NotificationModel();
		
		//if(!isset($_GET['workid']) || $_GET['workid'] == ''):
		//	$this -> redirecttohomepage();
		//endif;

		$this -> usrdetails = $this -> getuserdetailfromusername($_GET['workid']);
		$this -> usrid = $this -> usrdetails['id'];

		$this -> getuserimages = $this -> getartistsimages();
		$this -> getpreviewcategories = $this -> getpreviewcategories();

		
		$this -> getnotifications1 = $this -> getnotifications();
	}
	
	function getnotifications(){
		$qry1="SELECT tbl_notification.*,tbl_users.username ,tbl_category.categoryName as categoryname FROM tbl_notification LEFT JOIN tbl_users on tbl_notification.requesteduser = tbl_users.id LEFT JOIN tbl_category on tbl_notification.objectcat = tbl_category.id WHERE tbl_notification.userid='".$_SESSION['po_userses']['flc_usrlogin_id']."' ORDER BY id DESC";
		$result1 = $this->modelObj->fetchRows($qry1);
		if(!empty($result1[0])){
			$qryUpdate = "UPDATE tbl_notification SET status='0' WHERE id = ".$result1[0]['id'];
			$this->modelObj->runQuery($qryUpdate);
		}
		return $result1;
	}
	
	
	
	
	function getartistsimages(){
	  $qry="SELECT * FROM tbl_user_images WHERE status=1 AND user_id = '".$this -> usrid."' ORDER BY cr_date DESC";
      return $result = $this->modelObj->fetchRows($qry);
	}
	function getpreviewcategories(){
	  $qry="SELECT preview_category FROM tbl_users WHERE status = 1 AND id = ".$this -> usrid;
      return $result = $this->modelObj->fetchRow($qry);
	}
	function getartistcategorydetailbyid($catid){
		$qry="SELECT * FROM tbl_category WHERE id = '".clear_input($catid)."' and status = 1 LIMIT 1";
		return $result = $this->modelObj->fetchRow($qry);
	}
	function getartistimagelistbycatid($catid){
		$qry="SELECT * FROM tbl_user_images WHERE status=1 AND user_id = '".$this -> usrid."' AND category_id = '".$catid."' ORDER BY image_rank ASC";
      	return $result = $this->modelObj->fetchRows($qry);
	}
	function getartistimageinactivelistbycatid(){
		$qry="SELECT * FROM tbl_user_images WHERE status=0 AND user_id = '".$this -> usrid."' ORDER BY image_rank ASC";
      	return $result = $this->modelObj->fetchRows($qry);
	}
	
	

}
?>