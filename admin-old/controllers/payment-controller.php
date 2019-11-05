<?php
	class PaymentController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new PaymentModel();
			$this->getpayment = $this->getPayment();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getPayment(){
		  $qry="SELECT * FROM tbl_payment where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_payment where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}

		function getusernamebyid($userid){
		  $qry = "SELECT first_name, last_name FROM tbl_users where status!=2 AND id='".$userid."' LIMIT 1";
		  return $result = $this->modelObj->fetchRow($qry);
		}
		function getplannamebyid($planid){
		  $qry = "SELECT plan_name FROM tbl_plans where status!=2 AND id='".$planid."' LIMIT 1";
		  return $result = $this->modelObj->fetchRow($qry);
		}
	}
	?>