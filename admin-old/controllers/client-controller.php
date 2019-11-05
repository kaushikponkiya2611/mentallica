<?php
	class ClientController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new ClientModel();
			$this->getclient = $this->getClient();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getClient(){
		  $qry="SELECT * FROM tbl_users where status!=2 and usertype=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_users where status!=2 and usertype=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>