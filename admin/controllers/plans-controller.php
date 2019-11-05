<?php
	class PlansController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new PlansModel();
			$this->getplans = $this->getPlans();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getPlans(){
		  $qry="SELECT * FROM tbl_plans where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_plans where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>