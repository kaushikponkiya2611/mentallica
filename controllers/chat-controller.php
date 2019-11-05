<?php
class ChatController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new ChatModel();

		$this -> userdetail = $this -> profileinfo();
		$this -> gtplans = $this -> getplandetails($this -> userdetail['plan_id']);
		//$this -> gtcategory = $this -> getcategorylistbyids($this -> gtplans['category']);
		$this -> gtcategory = $this -> getcategorylist($this -> gtplans['category']);

		if(isset($_FILES["file_img_upload"]["tmp_name"]) && $_POST['sel_category'] != '' && count($_POST) > 0):
			//$usr_update = $this -> updateuserdetails($_POST['txt_firstname'], $_POST['txt_lastname'], $_POST['txt_mobileno']);
			$upload_dir =$_SESSION['SITE_IMG_PATH']."images/";
			$upload_dirthumb =$_SESSION['SITE_IMG_PATH']."images/thumb/";
			$upload_dir150 =$_SESSION['SITE_IMG_PATH']."images/150/";
			$upload_dir300 =$_SESSION['SITE_IMG_PATH']."images/300/";
			if(!dir($upload_dir))
			{
				mkdir($upload_dir);
			}
			if(!dir($upload_dirthumb))
			{
				mkdir($upload_dirthumb);
			}
			if(!dir($upload_dir150))
			{
				mkdir($upload_dir150);
			}
			if(!dir($upload_dir300))
			{
				mkdir($upload_dir300);
			}
			if(isset($_FILES["file_img_upload"]["tmp_name"]))
			{
				$tmpfile = $_FILES["file_img_upload"]["tmp_name"];
				$newname = $_FILES["file_img_upload"]["name"];				
				$insertimage="";
				if($_FILES["file_img_upload"]["tmp_name"] != '')
				{
					$abc=date("dmyHis");
					$insertimage=$abc.$newname;
					if(move_uploaded_file($tmpfile, $upload_dir.$insertimage))
					{
					  	$resizeObj_20 = new resize($upload_dir.$insertimage); 
					  	$resizeObj_20 -> resizeImage(50, 50, 'exact');
					  	$resizeObj_20 -> saveImage($upload_dirthumb.$insertimage,$upload_dir.$insertimage, 100);

					  	$resizeObj_150 = new resize($upload_dir.$insertimage); 
					  	$resizeObj_150 -> resizeImage(150, 100, 'landscape');
					  	$resizeObj_150 -> saveImage($upload_dir150.$insertimage,$upload_dir.$insertimage, 100);

					  	$resizeObj_300 = new resize($upload_dir.$insertimage); 
					  	$resizeObj_300 -> resizeImage(300, 225, 'portrait');
					  	$resizeObj_300 -> saveImage($upload_dir300.$insertimage,$upload_dir.$insertimage, 100);

					  	$usr_insert_img = $this -> insertuserimage($insertimage, $_POST['txt_img_title'], $_POST['txt_img_text'], $_POST['sel_currency'], $_POST['txt_img_price'], $_POST['sel_category'], $this -> userdetail['image_limit']);
					}
				}
			}
			header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."imgupload/");
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
	function insertuserimage($insertimage, $imgtitle, $imgtext, $currency, $imgprice, $catid, $imglimit){
		$qry = "INSERT INTO `tbl_user_images`(`user_id`, `image`, `img_title`, `image_text`, `price_currency`, `img_price`, `category_id`, `cr_date`, `status`) VALUES ('".$_SESSION['po_userses']['flc_usrlogin_id']."','".clear_input($insertimage)."','".clear_input($imgtitle)."','".clear_input($imgtext)."','".clear_input($currency)."','".clear_input($imgprice)."','".clear_input($catid)."',NOW(),1)";
		$result = $this->modelObj->runQuery($qry);

		$lastid = mysql_insert_id();
		if($lastid && $lastid > 0):
			$imglimit = $imglimit - 1;
			$qry2 = "UPDATE tbl_users SET image_limit = '".clear_input($imglimit)."' WHERE status = 1 AND id = ".$_SESSION['po_userses']['flc_usrlogin_id'];
			$result2 = $this->modelObj->runQuery($qry2);
		endif;

		return $result;
	}
}
?>