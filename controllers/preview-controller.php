<?php
class PreviewController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new PreviewModel();
		
		$this -> getuserimages = $this -> getuserimages();
		$this -> getpreviewcategories = $this -> getpreviewcategories();
		$this -> getpreviewmusic = $this -> getpreviewmusic();
		$this -> getsavedmusic = $this -> getsavedmusic();
	}
	
	function getpreviewcategories(){
       $uid = $_SESSION['po_userses']['flc_usrlogin_id'];
        if((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist']!='')){
            $uid = $_SESSION['current_artist'];
        } 
        
        
	  $qry="SELECT preview_category FROM tbl_users WHERE status = 1 AND id = ".$uid;
      return $result = $this->modelObj->fetchRow($qry);
	}
	
	function getsavedmusic(){
		$timelineArg =array();
		$musics = mysql_query("SELECT timeline FROM  tbl_radio_host where `user_id` =".$_SESSION['po_userses']['flc_usrlogin_id']);
		while($msc=mysql_fetch_array($musics)){
			$timeline = $msc['timeline'];
			$timelineArg = explode(",",$timeline);
		}
		return $timelineArg;
	}
	
	function getpreviewmusic(){
		$allmusic = array();
		$musics=mysql_query("SELECT * FROM tbl_user_images WHERE status=1 AND user_id = '" . $_SESSION['po_userses']['flc_usrlogin_id'] . "' and music!='' ORDER BY cr_date DESC");
		while($msc=mysql_fetch_array($musics)){
			$allmusic[] = $msc['music'];
		}
		$musics2=mysql_query("SELECT * FROM tbl_music WHERE status=1 AND uid = '" . $_SESSION['po_userses']['flc_usrlogin_id'] . "' and title!='' ORDER BY cr_date DESC");
		while($msc2=mysql_fetch_array($musics2)){
			$allmusic[] = $msc2['title'];
		}
		$allmusic = array_unique($allmusic);
		return $allmusic;
	}
	
}
?>