<?php
class HomeController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new HomeModel();
	}
}
?>