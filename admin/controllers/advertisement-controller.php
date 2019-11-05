<?php
	class AdvertisementController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new AdvertisementModel();
			$this->getadvertisement = $this->getAdvertisement();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getAdvertisement(){
		  $qry="SELECT * FROM tbl_advertisement where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_advertisement where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>