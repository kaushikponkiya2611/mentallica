<?php 
    @session_start();
	include('../../models/db.php');
	include('../../models/common-model.php');
	include('../../includes/thumb_new.php');
	include('../common-controller.php');
	$database = new Connection();
	include('../../models/ajax-model.php');
	$modelObj = new AjaxModel();
	$upload_dir = $_SERVER['DOCUMENT_ROOT']."LiveHR/admin/upload/usercsv/";
?>
<?php
if(isset($_POST['hid_uploadcsv']) && $_POST['hid_uploadcsv'] != '')
{
     $tmpfile = $_FILES["file_uploadcsv"]["tmp_name"];
     $newname = $_FILES["file_uploadcsv"]["name"];
      if($_FILES['file_uploadcsv']['tmp_name'] != '')
	  {
	  	  $size=$_FILES['file_uploadcsv']['size'];
	      $result = move_uploaded_file($tmpfile, $upload_dir.$newname);	
		  $fileread = $upload_dir.$newname;			
		  $file = fopen($fileread,"r");
		  $csvcontent = fread($file,$size);
		  
		  if (($handle = fopen($fileread,"r")) !== FALSE)
		  {
		        $firstrow = 0;
				$fnameflag = 0;
				$mnameflag = 0;
				$lnameflag = 0;
				$emailidflag = 0;
				$flags = 0;
				while (($data = fgetcsv($handle, $csvcontent, "\t")) !== FALSE) 
				{
				    $arr =  array();
					$num = count($data);
					$flags=1;
					   for ($c=0; $c <$num; $c++)
					   {
					       if($data[$c] != '')
						   {
						     if(strtolower(trim($data[$c])) == 'first_name' || strtolower(trim($data[$c])) == 'middle_name' || strtolower(trim($data[$c])) == 'last_name' || strtolower(trim($data[$c])) == 'emailid')
							 {
								if(trim(strtolower($data[$c])) == 'first_name')
								{
									$fnameindex  = $c;
									$fnameflag = 1;
								}
								if(trim(strtolower($data[$c])) == 'middle_name')
								{
									$mnameindex  = $c;
									$mnameflag = 1;
								}
								if(trim(strtolower($data[$c])) == 'last_name')
								{
									$lnameindex  = $c;
									$lnameflag  = 1;
								}
								if(trim(strtolower($data[$c])) == 'emailid')
								{
									$emailidindex  = $c;
									$emailidflag  = 1;
								}
							}
							else 
							{
							
							   $fname = $data[$fnameindex];
						       $mname = $data[$mnameindex];
							   $lname = $data[$lnameindex];
							   $emailid = $data[$emailidindex];
							   $qry = "SELECT * FROM tbl_user WHERE emailid = '".mysql_real_escape_string(trim($emailid))."' and Status !=2";
							   $result = $modelObj -> fetchRow($qry);
							   if(strtolower(trim($result['emailid'])) == strtolower(trim($emailid)))
							   {
									$flag = 0;
							   }
							   else
							   {
									$flag = 1;
							   }
							   
							   if($flag == 1)
							   {
								   $qry = mysql_query("INSERT INTO tbl_user (first_name,middle_name,last_name,emailid,Created_date,Status) 
											VALUES ('".mysql_real_escape_string(trim($fname))."',
											'".mysql_real_escape_string(trim($mname))."',
											'".mysql_real_escape_string(trim($lname))."',
											'".mysql_real_escape_string(trim($emailid))."',
											NOW(),1)");
								}									
							   $msg = 1;
						   }
					   }
					}
					$firstrow++;
				}
				fclose($handle);
		   }			
	  }
	  if($flags==0)
	  {
	  	echo "3";
	  }
	  else
	  {
	 	echo $msg;
	  }
}
?>
<?php
if(isset($_POST['view']) && $_POST['view'] != ''){
    $id = $_POST['id'];
	$qry = "SELECT * FROM tbl_zipcode WHERE Id = '".mysql_real_escape_string($id)."'";
	$result = $modelObj->fetchRow($qry);
	$qry_country="SELECT * FROM tbl_country WHERE Id='".$result["countryId"]."' ";
	$result_crty = $modelObj->fetchRow($qry_country);
	$qry_state="SELECT * FROM tbl_state WHERE Id='".$result["stateId"]."' ";
	$result_state= $modelObj->fetchRow($qry_state);
	$qry_city="SELECT * FROM tbl_city WHERE Id='".$result["cityId"]."' ";
	$result_city = $modelObj->fetchRow($qry_city);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px">
      <tr class="light_bg">
        <td width="120" align="right" class="popup_listing_border"><strong>Zipcode :</strong></td>
        <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['zipCode']) ?></td>
      </tr>
	  <tr class="white_bg">
        <td align="right" class="popup_listing_border"><strong>Country Name :</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border"><?php echo stripslashes($result_crty['countryName']) ?></td>
      </tr>
	  <tr class="light_bg">
        <td align="right" class="popup_listing_border"><strong>State Name :</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border"><?php echo stripslashes($result_state['stateName']) ?></td>
      </tr>
	  <tr class="white_bg">
        <td align="right" class="popup_listing_border"><strong>City Name :</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border"><?php echo stripslashes($result_city['cityName']) ?></td>
      </tr>      
</table>
<?php } ?>

<?php
if(isset($_POST['statusactive']) && $_POST['statusactive'] != '')
{
	$id = explode("," ,$_POST['active']);
	foreach($id as $k => $val)
	{
		$qry = "UPDATE  tbl_zipcode  SET status = 1 WHERE Id = ".mysql_real_escape_string($val);
		$result =  $modelObj->runQuery($qry);
	}
}
?>
<?php
if(isset($_POST['statusinactive']) && $_POST['statusinactive'] != '')
{
	$id = explode("," ,$_POST['inactive']);
	foreach($id as $k => $val)
	{
		$qry = "UPDATE  tbl_zipcode  SET status = 0 WHERE Id = ".mysql_real_escape_string($val);
		$result =  $modelObj->runQuery($qry);
	}
}
?>
<?php
if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
	$id = explode("," ,$_POST['delete']);
	foreach($id as $k => $val)
	{
		$qry = "UPDATE  tbl_zipcode  SET status = 2 WHERE Id = ".mysql_real_escape_string($val);
		$result =  $modelObj->runQuery($qry);
	}
}
?>
<?php
if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){
	$qry = "SELECT zipCode FROM tbl_zipcode WHERE status!=2 and stateId='".mysql_real_escape_string(trim($_POST['txt_state']))."' and zipCode = '".mysql_real_escape_string($_POST['txt_zipcode'])."' ";
	$result = $modelObj -> fetchRow($qry);
	
	if(strtolower(trim($result['zipCode'])) == strtolower(trim($_POST['txt_zipcode'])))
	{
		$flag = 0;
	}
	else
	{
		$flag = 1;
	}
	
	if($flag == 1)
	{
		$qry = "INSERT INTO tbl_zipcode (zipCode,cityId,stateId,countryId,status) 
		VALUES ('".clear_input($_POST['txt_zipcode'])."',
		'".clear_input($_POST['txt_city'])."',
		'".clear_input($_POST['txt_state'])."',
		'".clear_input($_POST['txt_country'])."',1)";
		$result = $modelObj->runQuery($qry);
		if($result)
		{
			echo "1";
		}else
		{
			echo "2";	 
		}
   }
   else
   {
     echo "0";
   }
}
?>
<?php
if(isset($_POST['statusid']) && $_POST['statusid'] != ''){
	$qry = "UPDATE  tbl_zipcode  SET status = ".mysql_real_escape_string($_POST['status'])." WHERE Id = ".mysql_real_escape_string($_POST['statusid']);
	$result =  $modelObj->runQuery($qry);
}
?>
<?php
if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){
	$qry = "SELECT zipCode FROM tbl_zipcode WHERE status!=2 and stateId='".mysql_real_escape_string(trim($_POST['txt_state']))."' and zipCode = '".mysql_real_escape_string($_POST['txt_zipcode'])."' and Id != '".$_POST['hid_userid']."'";
	$result = $modelObj -> fetchRow($qry);
	
	if(strtolower(trim($result['zipCode'])) == strtolower(trim($_POST['txt_zipcode'])))
	{
		$flag = 0;
	}
	else
	{
		$flag = 1;
	}
	
	if($flag == 1)
	{
		$qry = "UPDATE tbl_zipcode SET zipCode = '".clear_input($_POST['txt_zipcode'])."',cityId = '".clear_input($_POST['txt_city'])."',stateId = '".clear_input($_POST['txt_state'])."', countryId = '".clear_input($_POST['txt_country'])."'  WHERE Id = '".mysql_real_escape_string($_POST['hid_userid'])."'";
		$result = $modelObj->runQuery($qry);
		if($result)
		{
			echo "1";
		}
		else
		{
			echo "2";	 
		}
	}
	else
	{
		echo "0";
	}
}
?>
<?php
if(isset($_POST['viewdiv']) && $_POST['viewdiv'] != ''){
	$start = $_POST['prevnext'];
	$end = $_POST['row'];
	$orderby=$_POST['orderby'];
	
	if($_POST['search'] != '0')
	{
		if(trim($_POST['txt_srchfname']) != '')
		{
			$searchqry .="and  z.zipCode LIKE '%".mysql_real_escape_string(trim($_POST['txt_srchfname']))."%'";
			$_SESSION['srchqry'] =  $searchqry; 
		}
		if(trim($_POST['txt_citya']) != '')
		{
			$searchqry .="and  c.cityName LIKE '%".mysql_real_escape_string(trim($_POST['txt_citya']))."%'";
			$_SESSION['srchqry'] =  $searchqry; 
		}
		if(trim($_POST['txt_statea']) != '')
		{
			$searchqry .="and  s.stateName LIKE '%".mysql_real_escape_string(trim($_POST['txt_statea']))."%'";
			$_SESSION['srchqry'] =  $searchqry; 
		}
		if(trim($_POST['txt_countrya']) != '')
		{
			$searchqry .="and  co.countryName LIKE '%".mysql_real_escape_string(trim($_POST['txt_countrya']))."%'";
			$_SESSION['srchqry'] =  $searchqry; 
		}
		$_SESSION['srchqry'] =  $_SESSION['srchqry']; 
	    
		if($_POST['fieldname'] == '0')
		{
			$qry = "SELECT * FROM tbl_country co,tbl_state s,tbl_city c,tbl_zipcode z WHERE z.countryId=co.Id and z.stateId=s.Id and z.cityId=c.Id and z.status != 2 ".$_SESSION['srchqry']."  order by z.Id  asc LIMIT $start,$end ";
		}
		else
		{
			$qry = "SELECT * FROM tbl_country co,tbl_state s,tbl_city c,tbl_zipcode z WHERE z.countryId=co.Id and z.stateId=s.Id and z.cityId=c.Id and z.status != 2 ".$_SESSION['srchqry']." ORDER BY ".$_POST['fieldname']." ".$orderby." LIMIT $start,$end";
		}
		$qry11 = mysql_query("SELECT * FROM tbl_country co,tbl_state s,tbl_city c,tbl_zipcode z WHERE z.countryId=co.Id and z.stateId=s.Id and z.cityId=c.Id and z.status != 2 ".$_SESSION['srchqry']."")or die(mysql_error());
	}
	else
	{
		if($_POST['fieldname'] == '0')
		{
			$qry = "SELECT * FROM tbl_country co,tbl_state s,tbl_city c,tbl_zipcode z WHERE z.countryId=co.Id and z.stateId=s.Id and z.cityId=c.Id and z.status != 2 order by z.Id desc LIMIT 0,$end ";
		}
		else
		{
			$qry = "SELECT * FROM tbl_country co,tbl_state s,tbl_city c,tbl_zipcode z WHERE z.countryId=co.Id and z.stateId=s.Id and z.cityId=c.Id and z.status != 2 ORDER BY ".$_POST['fieldname']." ".$orderby." LIMIT $start,$end";
		}	  
		$qry11 = mysql_query("SELECT * FROM tbl_country co,tbl_state s,tbl_city c,tbl_zipcode z WHERE z.countryId=co.Id and z.stateId=s.Id and z.cityId=c.Id and z.status != 2 ")or die(mysql_error());
	}
	$result = $modelObj->fetchRows($qry);
	$totalrecords = mysql_num_rows($qry11);
	$noofrows_k = $end;
	$noofpages = ceil($totalrecords/$noofrows_k);
	if($_POST['first'] != 0)
	{
		$curr_page =   ceil($start/$noofrows_k);
	}
	else if($_POST['last'] != 0)
	{
		$curr_page = 0;
	}
	else
	{
		$curr_page = $_POST['curr_page'];
	}
   	
?>
<script type="text/javascript">
$(document).ready(function () {
    $(".showhide-account").click(function () {
        $(".account-content").slideToggle("fast");
        $(this).toggleClass("active");
        return false;
    });
});

$(document).ready(function () {
    $(".action-slider").click(function () {
        $("#actions-box-slider").slideToggle("fast");
        $(this).toggleClass("activated");
        return false;
    });
});
$(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
	$('#toggle-all').toggleClass('toggle-checked');
	$('#form_userview input[type=checkbox]').checkBox('toggle');
	return false;
	});
});
</script> 
<form id="form_userview" action="" name="form_userview" method="post" enctype="multipart/form-data" onsubmit="return false">
<div class="searchdiv">
<table class="searchdiv" border="0" width="100%" cellpadding="0" cellspacing="0">
   <tr>
	 <td width="13%" align="left">
	<?php
	if($result != ''){
	?>
	<div id="actions-box">
		<a href="" class="action-slider"></a>
		<div id="actions-box-slider">
			<a style="cursor:pointer" class="action-delete" onclick="deleteselected()" id="testCheck">Delete</a>
			<a style="cursor:pointer" class="action-delete" onclick="statusactive()" id="testCheck">Active</a>
			<a style="cursor:pointer" class="action-delete" onclick="statusinactive()" id="testCheck">Inactive</a>
		</div>
		<div class="clear"></div>
	</div>
	<?php } ?>
	</td>
	<td width="16%">&nbsp;</td>
	<td width="64%">&nbsp;</td>
	<td width="7%" align="right" valign="bottom"><input class="button_bg" type="button" value="Search" name="btn_search" onclick="show_search()"></td>
   </tr>
</table>
</div>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
<tr>
	<th class="table-header-check"><a id="toggle-all" ></a> </th>
	<th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('z.zipCode','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="z_zipCode" class="cursorpointer">Zipcode </a></th>
	<th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('co.countryName','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="co_countryName" class="cursorpointer">Country Name </a></th>
	<th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('s.stateName','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="s_stateName" class="cursorpointer">State Name </a></th>
	<th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('c.cityName','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="c_cityName" class="cursorpointer">City Name </a></th>	
	<th class="table-header-options line-left"><a href="">Options</a></th>
</tr>
<?php
$i=0;
if($result != ''){
	foreach($result  as $k => $data){
		$i++;	
?>
	<tr id="<?php echo $data['Id']?>" class="<?php if($i%2==0){ echo "light_bg"; }else{ echo "white_bg"; } ?>" height="30">
		<td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['Id'];  ?>"/></td>
		<td class="cursorpointer" onclick="edit('<?php echo $data['Id'] ?>','<?php echo $_SESSION['pid']?>')"><?php echo stripslashes($data['zipCode']); ?></td>
		<td><?php echo stripslashes($data['countryName']);?></td>
		<td><?php echo stripslashes($data['stateName']);?></td>
		<td><?php echo stripslashes($data['cityName']);?></td>	
		  <td class="options-width" >
			<table id="tables_options">
				<tr>
					<td>
						<?php
						if($data['status'] == '1')
						{
						?>
						<div id="d_<?=$data['Id']?>">
						<a id="s_<?=$data['Id']?>" style="cursor:pointer;" title="Active" class="icon-active info-tooltip" onclick="changeStatus('<?=$data['Id']?>');"></a>
						</div>
						<input type="hidden" id="status_<?=$data['Id']?>" name="status_<?=$data['Id']?>" value="Active" />						
						<?php
						}
						else
						{
						?>
						<div id="d_<?=$data['Id']?>">
						<a id="s_<?=$data['Id']?>" style="cursor:pointer;" title="Inactive" class="icon-inactive info-tooltip" onclick="changeStatus('<?=$data['Id']?>');"></a>
						</div>
						<input type="hidden" id="status_<?=$data['Id']?>" name="status_<?=$data['Id']?>" value="Inactive" />						
						<?php
						}
						?>
					</td>
					<td><a style="cursor:pointer" title="View" class="icon-view info-tooltip" onclick="view('<?php echo $data['Id'] ?>')"></a></td>
					<td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['Id'] ?>','<?php echo $_SESSION['pid']?>')"></a></td>
					<td><a style="cursor:pointer" title="Delete" class="icon-delete info-tooltip" onclick="deleteuser('<?php echo $data['Id'] ?>')" ></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<?php 
		} 
	 }
	 else
	 { 
	 ?>
		 <tr height="30"><td colspan="6" align="center" style="color:#FF0000"><strong><?php echo "No zipcode found."; ?></strong></td></tr>
	 <?php 
	 }
	 ?>
	</table>

<?php
if($result != ''){
	echo $modelObj->ajaxpaging_advancesearch($start,$result_numrec,$curr_page,$noofpages,$noofrows_k,$end);
  ?>
<?php }else{ ?>
	<input type="hidden" name="sel_noofrow" id="sel_noofrow" value="5" />
<?php } ?>
	<input type="hidden" name="hid_fieldname" id="hid_fieldname"    value="<?=$_POST['fieldname']?>"  />
	<input type="hidden" name="hidsearch" id="hidsearch" 
	value="<?php if($_POST['search'] != '0') echo '1'; else echo '0' ?>" />
	<input type="hidden" name="viewdiv" id="viewdiv" value="1" />
</form>
<?php 
} ?>

<?php
if(isset($_POST['delete']) && $_POST['delete'] != ''){
      $qry = "UPDATE tbl_zipcode SET status = 2 WHERE Id = '".$_POST['id']."'";
	  $result = $modelObj->runQuery($qry);
	  if($result){
	    echo $successmsg = '1';
	  }else{
	    echo $errmsg = '0';
	  }
 }
?>

<?php
if(isset($_POST['edit']) && $_POST['edit'] != ''){
	$qry = "SELECT * FROM tbl_zipcode WHERE Id = '".$_POST['id']."'";
	$data = $modelObj->fetchRow($qry);
	$qry_country="SELECT * FROM tbl_country WHERE status=1 order by countryName asc";
	$result_crty = $modelObj->fetchRows($qry_country);
	$qry_state="SELECT * FROM tbl_state WHERE status=1 order by stateName asc";
	$result_state= $modelObj->fetchRows($qry_state);
	$qry_city="SELECT * FROM tbl_city WHERE status=1 order by cityName asc";
	$result_city = $modelObj->fetchRows($qry_city);
?>
<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script>
<form name="form_useradd" id="form_useradd" method="post" enctype="multipart/form-data" action="#" >
	<table border="0" cellpadding="0" cellspacing="0" id="id-form" width="100%">
		<tr class="light_bg">
			<th>Country Name :</th>
			<td width="25%">
				<select class="select_box" name="txt_country" id="txt_country" onblur="checkfield(this)" onchange="getStates()">
					<option value="">Select Country</option>
					<?php
						if($result_crty != '')
						{
							foreach($result_crty  as $k => $data1)
							{
								if($data['countryId']==$data1['Id'])
								{
									echo "<option selected='selected' value='".$data1['Id']."'>".stripslashes($data1['countryName'])."</option>";
								}
								else
								{
									echo "<option value=".$data1['Id'].">".stripslashes($data1['countryName'])."</option>";
								}
							}
						}
					?>
				</select><font class="required"> *</font>
			</td>
			<td id="errortxt_country" width="55%">
			<label class="removerror error_new" id="error-innertxt_country"></label>
            </td>
		</tr>
		<tr class="white_bg">
			<th>State Name :</th>
			<td id="stateajax">
				<select class="select_box"  name="txt_state" id="txt_state" onblur="checkfield(this)" onchange="getCities()">
					<option value="">Select State</option>
					<?php
						if($result_state != '')
						{
							foreach($result_state  as $k => $data1)
							{
								if($data['stateId']==$data1['Id'])
								{
									echo "<option selected='selected' value='".$data1['Id']."'>".stripslashes($data1['stateName'])."</option>";
								}
								else if($data['countryId']==$data1['countryId'])
								{
									echo "<option value='".$data1['Id']."'>".stripslashes($data1['stateName'])."</option>";
								}
							}
						}
					?>
				</select><font class="required"> *</font>
			</td>
			<td id="errortxt_state">
			<label class="removerror error_new" id="error-innertxt_state"></label>
            </td>
		</tr>
		<tr class="light_bg">
			<th>City Name :</th>
			<td id="cityajax">
				<select class="select_box"  name="txt_city" id="txt_city" onblur="checkfield(this)">
					<option value="">Select City</option>
					<?php
						if($result_city != '')
						{
							foreach($result_city  as $k => $data1)
							{
								if($data['cityId']==$data1['Id'])
								{
									echo "<option selected='selected' value='".$data1['Id']."'>".stripslashes($data1['cityName'])."</option>";
								}
								else if($data['stateId']==$data1['stateId'])
								{
									echo "<option value='".$data1['Id']."'>".stripslashes($data1['cityName'])."</option>";
								}
							}
						}
					?>
				</select><font class="required"> *</font>
			</td>
			<td id="errortxt_city">
			<label class="removerror error_new" id="error-innertxt_city"></label>
            </td>
		</tr>
		<tr class="white_bg">
			<th>Zipcode :</th>
			<td width="20%"><input type="text" class="input_box"  name="txt_zipcode" id="txt_zipcode" value="<?php echo stripslashes($data['zipCode']) ?>" onblur="checkfield(this)" /><font class="required"> *</font></td>
			<td id="errortxt_zipcode">
			<label class="removerror error_new" id="error-innertxt_zipcode"></label>
            </td>
		</tr>
		<tr class="light_bg">
			<th>&nbsp;</th>
			<td valign="top">
			<?php 
			if($_POST['id'] !=0)
			{
			?>
				<input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data['Id'] ?>" />
				<input type="hidden" name="hid_update" id="hid_update" value="update" />
				<input class="button_bg" type="submit" value="Submit" name="btn_update" onclick="return updatedata()">
				<input class="button_bg" type="button" value="Cancel" name="btn_cancel" onclick="newdata()">
			<?php
			}
			else
			{
			?>
				<input type="hidden" name="hid_add" id="hid_add" value="add" />
				<input class="button_bg" type="submit" value="Submit" name="btn_save" onclick="return adddata()">
				<input class="button_bg" type="button" value="Cancel" name="btn_cancel" onclick="newdata()">
			<?php
			}
			?>
			</td>
			<td></td>
		</tr>
	</table>
    </form>
<?php 
  }
?>
<?php 
if(isset($_POST['getstateid'])){
$qry_s="SELECT * FROM tbl_state WHERE status =1 and countryId='".$_POST['getstateid']."' order by stateName asc";
$result_s = $modelObj->fetchRows($qry_s);
?>
<select class="select_box"  name="txt_state" id="txt_state" onblur="checkfield(this)" onchange="getCities()">
	<option value="">Select State</option>
	<?php
		if($result_s != '')
		{
			foreach($result_s  as $k => $data1)
			{
				echo "<option value=".$data1['Id'].">".stripslashes($data1['stateName'])."</option>";
			}
		}
	?>
</select><font class="required"> *</font>
<?php
}
?>
<?php 
if(isset($_POST['getcityid'])){
$qry_s="SELECT * FROM tbl_city WHERE status =1 and stateId='".$_POST['getcityid']."' order by cityName asc";
$result_s = $modelObj->fetchRows($qry_s);
?>
<select class="select_box"  name="txt_city" id="txt_city" onblur="checkfield(this)">
	<option value="">Select City</option>
	<?php
		if($result_s != '')
		{
			foreach($result_s  as $k => $data1)
			{
				echo "<option value=".$data1['Id'].">".stripslashes($data1['cityName'])."</option>";
			}
		}
	?>
</select><font class="required"> *</font>
<?php
}
?>
