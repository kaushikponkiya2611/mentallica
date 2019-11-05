<?php
	class Radio_advertisementController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new Radio_advertisementModel();
			$this->getradio_advertisement = $this->getRadio_advertisement();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getRadio_advertisement(){
		  $qry="SELECT * FROM tbl_radio_advertisement where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_radio_advertisement where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>