<?php
class CountryController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new CountryModel();
		$this->getcountry = $this->getCountry();
		$this->gettotalpageno = $this->gettotalpageno();
	}
	
	function getCountry(){
	 $qry_country = "SELECT * FROM tbl_country WHERE status != 2 order by Id desc LIMIT 0,20";
	  //$qry_country = "SELECT * FROM countries order by name asc LIMIT 0,20";
      return $result = $this->modelObj->fetchRows($qry_country);
	}
	
	function gettotalpageno(){
	  //$qry = "SELECT * FROM tbl_country WHERE status != 2 ";
	  $qry = "SELECT * FROM countries";
	  return $result = $this->modelObj->numRows($qry);
	}
}
?>