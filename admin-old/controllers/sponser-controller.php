<?php
	class SponserController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new SponserModel();
			$this->getsponser = $this->getSponser();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getSponser(){
		  $qry="SELECT * FROM tbl_sponser where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_sponser where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>