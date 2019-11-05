<?php
class ChangepasswordController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new ChangepasswordModel();
	//	$this->getuser = $this->getUser();
	//	$this->gettotalpageno = $this->gettotalpageno();
	}
}
?>
	
