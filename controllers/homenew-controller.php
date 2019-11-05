<?php
class HomenewController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new HomenewModel();
	}
}
?>