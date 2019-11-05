<?php 
@session_start();
error_reporting(0);
include('../../models/db.php');
include('../../models/common-model.php');
include('../../includes/thumb_new.php');
include('../../includes/resize-class.php');
include('../common-controller.php');
$database = new Connection();
include('../../models/ajax-model.php');
$modelObj = new AjaxModel();
//$commoncont = new CommonController();
?>
<?php
/*
if(isset($_POST['getStateListByCountry']) && $_POST['getStateListByCountry'] != ''):
  	$qry="SELECT * FROM tbl_state WHERE status = 1 AND countryId = '".clear_input($_POST['cnt_id'])."' ORDER BY stateName ASC";
	$result = $modelObj->fetchRows($qry);	
	?><option value="">Select State</option><?php		
	foreach ($result as $k => $stlist):?>
	<option value="<?php echo $stlist['Id'];?>"><?php echo $stlist['stateName'];?></option>
	<?php endforeach;
endif;

if(isset($_POST['getCityListByCountry']) && $_POST['getCityListByCountry'] != ''):
  	$qry="SELECT * FROM tbl_city WHERE status = 1 AND stateId = '".clear_input($_POST['st_id'])."' ORDER BY cityName ASC";
	$result = $modelObj->fetchRows($qry);	
	?><option value="">Select City</option><?php		
	foreach ($result as $k => $ctlist):?>
	<option value="<?php echo $ctlist['Id'];?>"><?php echo $ctlist['cityName'];?></option>
	<?php endforeach;
endif;*/
if(isset($_POST['getStateListByCountry']) && $_POST['getStateListByCountry'] != ''):
  	$qry="SELECT * FROM regions WHERE country_id = '".clear_input($_POST['cnt_id'])."' GROUP BY name ORDER BY name ASC";
	$result = $modelObj->fetchRows($qry);	 
	?><option value="">Select State</option><?php		
	foreach ($result as $k => $stlist):?>
	<option value="<?php echo $stlist['id'];?>"><?php echo $stlist['name'];?></option>
	<?php endforeach;
endif;

if(isset($_POST['getCityListByCountry']) && $_POST['getCityListByCountry'] != ''):
  	$qry="SELECT * FROM cities WHERE region_id = '".clear_input($_POST['st_id'])."' GROUP BY name ORDER BY name ASC";
	$result = $modelObj->fetchRows($qry);	
	?><option value="">Select City</option><?php		
	foreach ($result as $k => $ctlist):?>
	<option value="<?php echo $ctlist['id'];?>"><?php echo $ctlist['name'];?></option>
	<?php endforeach;
endif;
if(isset($_POST['getCityListByCountryChk']) && $_POST['getCityListByCountryChk'] != ''):
  	//$qry="SELECT * FROM cities WHERE region_id = '".clear_input($_POST['st_id'])."' GROUP BY name ORDER BY name ASC";
        $qry="SELECT * FROM tbl_city WHERE stateId = '".clear_input($_POST['st_id'])."' GROUP BY cityName ORDER BY cityName ASC";
	$result = $modelObj->fetchRows($qry);	
	?><option value="">Select City</option><?php		
	foreach ($result as $k => $ctlist):?>
	<option value="<?php echo $ctlist['Id'];?>"><?php echo $ctlist['cityName'];?></option>
	<?php endforeach;
endif;
 
?>