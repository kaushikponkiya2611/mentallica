<?php
class AccessdetailController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new AccessdetailModel();
		
		$this -> _allacess = $this -> _allaccess();
	}
	
	function _allaccess(){
		$stringd = $_SERVER['REQUEST_URI'];
		$stringdArg =  explode("=",$stringd);
		$imgID = $stringdArg[1];
		if(!empty($imgID)){
			$qry1="SELECT ca.*,tu.*,ca.id as cmp_assign_id FROM tbl_company_artists_assign ca LEFT JOIN tbl_users tu on tu.id=ca.company_id where ca.id='".$imgID."'";
			$result1 = $this->modelObj->fetchRows($qry1);
			return $result1;
		}
		
		
	}
	

	

}
?>