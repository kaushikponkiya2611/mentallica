<?php
	class CustomerController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new CustomerModel();
			$this->getcustomer = $this->getCustomer();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getCustomer(){
		  $qry="SELECT * FROM tbl_customer where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_customer where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>