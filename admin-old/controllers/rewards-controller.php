<?php
	class RewardsController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new RewardsModel();
			$this->getrewards = $this->getRewards();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getRewards(){
		  $qry="SELECT * FROM tbl_rewards where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_rewards where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}

		function getusernamebyid($userid){
		  $qry = "SELECT first_name, last_name FROM tbl_users where status!=2 AND id='".$userid."' LIMIT 1";
		  return $result = $this->modelObj->fetchRow($qry);
		}

	}
	?>