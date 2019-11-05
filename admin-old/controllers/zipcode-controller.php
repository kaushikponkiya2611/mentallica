<?php
class ZipcodeController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new ZipcodeModel();
		$this->getzipcode = $this->getZipcode();
		$this->gettotalpageno = $this->gettotalpageno();
	}
	
	function getZipcode(){
	  $qry_zipcode = "SELECT * FROM tbl_country co,tbl_state s,tbl_city c,tbl_zipcode z WHERE z.status != 2 and z.countryId=co.Id and z.stateId=s.Id and z.cityId=c.Id order by z.Id desc LIMIT 0,20";
      return $result = $this->modelObj->fetchRows($qry_zipcode);
	}	
	function gettotalpageno(){
	  $qry = "SELECT * FROM tbl_country co,tbl_state s,tbl_city c,tbl_zipcode z WHERE z.status != 2 and z.countryId=co.Id and z.stateId=s.Id and z.cityId=c.Id";
	  return $result = $this->modelObj->numRows($qry);
	}
}
?>