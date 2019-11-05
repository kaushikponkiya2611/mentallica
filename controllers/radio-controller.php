<?php
	class RadioController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new RadioModel();
			$this->getradio = $this->getRadio();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getRadio(){
		  $qry="SELECT * FROM tbl_music where status!=2 order by start_time asc";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_music where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>