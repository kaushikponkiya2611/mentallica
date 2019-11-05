<?php
class CityController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new CityModel();
		$this->getcity = $this->getCity();
		$this->gettotalpageno = $this->gettotalpageno();
	}
	
	function getCity(){
	  $qry_country = "SELECT *,co.name as countryName,s.name as stateName FROM countries co,regions s,cities c WHERE c.status != 2 and c.country_id=co.id and c.region_id=s.id order by countryName asc LIMIT 0,20";
      return $result = $this->modelObj->fetchRows($qry_country);
	}
	function gettotalpageno(){
	  $qry = "SELECT * FROM countries co,regions s,cities c WHERE c.status != 2 and c.country_id=co.id and c.region_id=s.id";
	  return $result = $this->modelObj->numRows($qry);
	}
}
?>