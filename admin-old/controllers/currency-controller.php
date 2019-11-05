<?php
	class CurrencyController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new CurrencyModel();
			$this->getcurrency = $this->getCurrency();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getCurrency(){
		  $qry="SELECT * FROM tbl_currency where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_currency where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>