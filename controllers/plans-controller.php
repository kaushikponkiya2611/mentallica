<?php
class PlansController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new PlansModel();
		
		if(!isset($_SESSION['po_userses']['p_register_user']) || $_SESSION['po_userses']['p_register_user'] == ''):
			$_SESSION['po_userses']['login_error'] = '<h4>Fill this form </h4><p>Please fill this form first to register account.</p>';
			$_SESSION['po_userses']['login_error_cls'] = "callout-danger";
			header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."register/");
			exit;
		endif;
		$this -> allplans = $this -> getallplans();
	}
	
	function getallplans(){
		$qry = "SELECT * FROM tbl_plans WHERE status = 1 ORDER BY plan_price ASC";
		return $result = $this->modelObj->fetchRows($qry);
	}
}
?>