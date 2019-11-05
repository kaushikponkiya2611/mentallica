<?php
class EmployeemanagementController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new EmployeemanagementModel();
		$this->getemployee = $this->getEmployee();
		$this->gettotalpageno = $this->gettotalpageno();
	 
	}
	function getEmployee(){
	  $qry = "SELECT * FROM admin WHERE status != 2 order by firstname asc LIMIT 0,20";
      return $result = $this->modelObj->fetchRows($qry);
	}
	function gettotalpageno(){
	  $qry = "SELECT * FROM admin WHERE status != 2 ";
	  return $result = $this->modelObj->numRows($qry);
	}
}
?>