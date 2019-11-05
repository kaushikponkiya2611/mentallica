<?php
class ManageMenuController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new ManageMenuModel();
		$this->getmenu = $this->getMenu();
		$this->getsubmenu = $this->getSubMenu($menuid);
		//$this->getcountry=$this->getCountry();
		$this->gettotalpageno = $this->gettotalpageno();
	}
	
	function getMenu(){
	  $qry = "SELECT * FROM tbl_section WHERE status != 2 order by Order_no LIMIT 0,20";
      return $result = $this->modelObj->fetchRows($qry);
	}
	function getSubMenu($menuid){
	  $qry = "SELECT * FROM tbl_sectionlink WHERE status = 1 and Section_Id ='".$menuid."' order by Order_no";
      return $result = $this->modelObj->fetchRows($qry);
	}
	
	function gettotalpageno(){
	  $qry = "SELECT * FROM tbl_section WHERE status != 2";
	  return $result = $this->modelObj->numRows($qry);
	}
}
?>