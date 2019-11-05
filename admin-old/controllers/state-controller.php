<?php
class StateController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new StateModel();
		$this->getstate = $this->getState();
		$this->gettotalpageno = $this->gettotalpageno();
	}
	
	function getState(){
	  $qry_country = "SELECT *,c.name as countryName FROM countries c,regions s WHERE s.status != 2 and s.country_id=c.id order by c.name asc LIMIT 0,20";
      return $result = $this->modelObj->fetchRows($qry_country);
	}
	
	function gettotalpageno(){
	  $qry = "SELECT * FROM countries c,regions s WHERE s.status != 2 and s.country_id=c.id";
	  return $result = $this->modelObj->numRows($qry);
	}
}
?>