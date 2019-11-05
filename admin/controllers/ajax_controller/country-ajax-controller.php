<?php 
    @session_start();
	include('../../models/db.php');
	include('../../models/common-model.php');
	include('../../includes/thumb_new.php');
	include('../common-controller.php');
	$database = new Connection();
	include('../../models/ajax-model.php');
	$modelObj = new AjaxModel();
	$upload_dir = $_SERVER['DOCUMENT_ROOT']."LiveHR/upload/usercsv/";
	$data;
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
	$qry = "SELECT * FROM countries WHERE Id = '".mysql_real_escape_string($id)."'";
	$result = $modelObj->fetchRow($qry);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px">
      <tr class="light_bg">
        <td width="120" align="right" class="popup_listing_border"><strong>Country Name :</strong></td>
        <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['name']) ?></td>
      </tr>
      <tr class="white_bg">
        <td align="right" class="popup_listing_border"><strong>Time Zone :</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border">
		<?php
			switch ($result['time_zone'])
			{
			case 'GMT -12:00':
				echo "(GMT -12:00) Eniwetok, Kwajalein";
				break;
			case 'GMT -11:00':
				echo "(GMT -11:00) Midway Island, Samoa";
				break;
			case 'GMT -10:00':
				echo"(GMT -10:00) Hawaii";
				break;
			case 'GMT -9:00':
				echo "(GMT -9:00) Alaska";
				break;
			case 'GMT -8:00':
				echo "(GMT -8:00) Pacific Time (US &amp; Canada)";
				break;
			case 'GMT -7:00':
				echo "(GMT -7:00) Mountain Time (US &amp; Canada)";
				break;
			case 'GMT -6:00':
				echo "(GMT -6:00) Central Time (US &amp; Canada), Mexico City";
				break;
			case 'GMT -5:00':
				echo "(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima";
				break;
			case 'GMT -4:00':
				echo "(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz";
				break;
			case 'GMT -3:30':
				echo "(GMT -3:30) Newfoundland";
				break;
			case 'GMT -3:00':
				echo "(GMT -3:00) Brazil, Buenos Aires, Georgetown";
				break;
			case 'GMT -2:00':
				echo "(GMT -2:00) Mid-Atlantic";
				break;
			case 'GMT -1:00':
				echo "(GMT -1:00 hour) Azores, Cape Verde Islands";
				break;
			case 'GMT':
				echo "(GMT) Western Europe Time, London, Lisbon, Casablanca";
				break;
			case 'GMT +1:00':
				echo "(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris";
				break;
			case 'GMT +2:00':
				echo "(GMT +2:00) Kaliningrad, South Africa";
				break;
			case 'GMT +3:00':
				echo "(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg";
				break;
			case 'GMT +3:30':
				echo "(GMT +3:30) Tehran";
				break;
			case 'GMT +4:00':
				echo "(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi";
				break;
			case 'GMT +4:30':
				echo "(GMT +4:30) Kabul";
				break;
			case 'GMT +5:00':
				echo "(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent";
				break;
			case 'GMT +5:30':
				echo "(GMT +5:30) Bombay, Calcutta, Madras, New Delhi";
				break;
			case 'GMT +5:45':
				echo "(GMT +5:45) Kathmandu";
				break;
			case 'GMT +6:00':
				echo "(GMT +6:00) Almaty, Dhaka, Colombo";
				break;
			case 'GMT +7:00':
				echo "(GMT +7:00) Bangkok, Hanoi, Jakarta";
				break;
			case 'GMT +8:00':
				echo "(GMT +8:00) Beijing, Perth, Singapore, Hong Kong";
				break;
			case 'GMT +9:00':
				echo "(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk";
				break;
			case 'GMT +9:30':
				echo "(GMT +9:30) Adelaide, Darwin";
				break;
			case 'GMT +10:00':
				echo "(GMT +10:00) Eastern Australia, Guam, Vladivostok";
				break;
			case 'GMT +11:00':
				echo "(GMT +11:00) Magadan, Solomon Islands, New Caledonia";
				break;
			case 'GMT +12:00':
				echo "(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka";
				break;
			default:
			  echo "Other Zone";
			} 
		 ?>
		</td>
      </tr>
</table>
<?php } ?>

<?php
if(isset($_POST['statusactive']) && $_POST['statusactive'] != '')
{
	$id = explode("," ,$_POST['active']);
	foreach($id as $k => $val)
	{
		$qry = "UPDATE  countries  SET status = 1 WHERE Id = ".mysql_real_escape_string($val);
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
		$qry = "UPDATE  countries  SET status = 0 WHERE Id = ".mysql_real_escape_string($val);
		$result =  $modelObj->runQuery($qry);
	}
}
?>
<?php
if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
	$id = explode("," ,$_POST['delete']);
	foreach($id as $k => $val)
	{
		$qry = "UPDATE  countries  SET status = 2 WHERE Id = ".mysql_real_escape_string($val);
		$result =  $modelObj->runQuery($qry);
		$qry_state = "UPDATE  tbl_state  SET status = 2 WHERE countryId = ".mysql_real_escape_string($val);
		$result =  $modelObj->runQuery($qry_state);
		$qry_city = "UPDATE  tbl_city  SET status = 2 WHERE countryId = ".mysql_real_escape_string($val);
		$result =  $modelObj->runQuery($qry_city);
		$qry_zip = "UPDATE  tbl_zipcode  SET status = 2 WHERE countryId = ".mysql_real_escape_string($val);
		$result =  $modelObj->runQuery($qry_zip);
	}
}
?>
<?php
if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){
	$qry = "SELECT name FROM countries WHERE status!=2 and name = '".mysql_real_escape_string(trim($_POST['txt_country']))."'";
	$result = $modelObj -> fetchRow($qry);
	
	if(strtolower(trim($result['name'])) == strtolower(trim($_POST['txt_country'])))
	{
		$flag = 0;
	}
	else
	{
		$flag = 1;
	}
	
	if($flag == 1)
	{
		$qry = "INSERT INTO countries (name,time_zone,status) 
		VALUES ('".clear_input($_POST['txt_country'])."',
		'".clear_input($_POST['txt_timez'])."',1)";
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
	$qry = "UPDATE  countries  SET status = ".mysql_real_escape_string($_POST['status'])." WHERE Id = ".mysql_real_escape_string($_POST['statusid']);
	$result =  $modelObj->runQuery($qry);
}
?>
<?php
if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){
	$qry = "SELECT name FROM countries WHERE status!=2 and name = '".mysql_real_escape_string($_POST['txt_country'])."' and Id != '".$_POST['hid_userid']."'";
	$result = $modelObj -> fetchRow($qry);
	
	if(strtolower(trim($result['name'])) == strtolower(trim($_POST['txt_country'])))
	{
		$flag = 0;
	}
	else
	{
		$flag = 1;
	}
	
	if($flag == 1)
	{
		$qry = "UPDATE countries SET name = '".clear_input($_POST['txt_country'])."', time_zone = '".clear_input($_POST['txt_timez'])."'  WHERE Id = '".mysql_real_escape_string($_POST['hid_userid'])."'";
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
			$searchqry .="and  name LIKE '%".mysql_real_escape_string(trim($_POST['txt_srchfname']))."%'";
			$_SESSION['srchqry'] =  $searchqry; 
		}
		$_SESSION['srchqry'] =  $_SESSION['srchqry']; 
	    
		if($_POST['fieldname'] == '0')
		{
			$qry = "SELECT * FROM countries WHERE status != 2 ".$_SESSION['srchqry']."  order by Id  asc LIMIT $start,$end ";
		}
		else
		{
			$qry = "SELECT * FROM countries WHERE status != 2 ".$_SESSION['srchqry']." ORDER BY ".$_POST['fieldname']." ".$orderby." LIMIT $start,$end";
		}
		$qry11 = mysql_query("SELECT * FROM countries WHERE status != 2 ".$_SESSION['srchqry']."")or die(mysql_error());
	}
	else
	{
		if($_POST['fieldname'] == '0')
		{
			$qry = "SELECT * FROM countries WHERE status != 2 order by Id desc LIMIT 0,$end ";/*$start,*/
		}
		else
		{
			$qry = "SELECT * FROM countries WHERE status != 2 ORDER BY ".$_POST['fieldname']." ".$orderby." LIMIT $start,$end";
		}	  
		$qry11 = mysql_query("SELECT * FROM countries WHERE status != 2 ")or die(mysql_error());
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
	<th class="table-header-repeat line-left minwidth-1">
	<a onclick="sortingbyfield('name','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="name" class="cursorpointer">Country Name </a></th>
	<th class="table-header-options line-left"><a>Options</a></th>
</tr>
<?php
$i=0;
if($result != ''){
	foreach($result  as $k => $data){
		$i++;
		$qry_country="SELECT * FROM countries WHERE Id='".$data['country']."'";
		$resultcontry =$modelObj->fetchRow($qry_country);
?>
	<tr id="<?php echo $data['id']?>" class="<?php if($i%2==0){ echo "light_bg"; }else{ echo "white_bg"; } ?>" height="30">
		<td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['id'];  ?>"/></td>
		<td class="cursorpointer" onclick="edit('<?php echo $data['id'] ?>','<?php echo $_SESSION['pid']?>')"><?php echo stripslashes($data['name']); ?></td>
		  <td class="options-width" >
			<table id="tables_options">
				<tr>
					<td>
						<?php
						if($data['status'] == '1')
						{
						?>
						<div id="d_<?php echo $data['id']?>">
						<a id="s_<?php echo $data['id']?>" style="cursor:pointer;" title="Active" class="icon-active info-tooltip" onclick="changeStatus('<?php echo $data['id']?>');"></a>
						</div>
						<input type="hidden" id="status_<?php echo $data['id']?>" name="status_<?php echo $data['id']?>" value="Active" />						
						<?php
						}
						else
						{
						?>
						<div id="d_<?php echo $data['id']?>">
						<a id="s_<?php echo $data['id']?>" style="cursor:pointer;" title="Inactive" class="icon-inactive info-tooltip" onclick="changeStatus('<?php echo $data['id']?>');"></a>
						</div>
						<input type="hidden" id="status_<?php echo $data['id']?>" name="status_<?php echo $data['id']?>" value="Inactive" />						
						<?php
						}
						?>
					</td>
					<td><a style="cursor:pointer" title="View" class="icon-view info-tooltip" onclick="view('<?php echo $data['id'] ?>')"></a></td>
					<td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['id'] ?>','<?php echo $_SESSION['pid']?>')"></a></td>
					<td><a style="cursor:pointer" title="Delete" class="icon-delete info-tooltip" onclick="deleteuser('<?php echo $data['id'] ?>')" ></a></td>
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
		 <tr height="30"><td colspan="6" align="center" style="color:#FF0000"><strong><?php echo "No country found."; ?></strong></td></tr>
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
	<input type="hidden" name="hid_fieldname" id="hid_fieldname"    value="<?php echo $_POST['fieldname']?>"  />
	<input type="hidden" name="hidsearch" id="hidsearch" 
	value="<?php if($_POST['search'] != '0') echo '1'; else echo '0' ?>" />
	<input type="hidden" name="viewdiv" id="viewdiv" value="1" />
</form>
<?php 
} ?>

<?php
if(isset($_POST['delete']) && $_POST['delete'] != ''){
      $qry = "UPDATE countries SET status = 2 WHERE Id = '".$_POST['id']."'";
	  $result = $modelObj->runQuery($qry);
	  $qry_state = "UPDATE tbl_state SET status = 2 WHERE countryId = '".$_POST['id']."'";
	  $result = $modelObj->runQuery($qry_state);
	  $qry_city = "UPDATE tbl_city SET status = 2 WHERE countryId = '".$_POST['id']."'";
	  $result = $modelObj->runQuery($qry_city);
	  $qry_zip = "UPDATE tbl_zipcode SET status = 2 WHERE countryId = '".$_POST['id']."'";
	  $result = $modelObj->runQuery($qry_zip);
	  if($result){
	    echo '1';
	  }else{
	    echo '0';
	  }
 }
?>

<?php
if(isset($_POST['edit']) && $_POST['edit'] != ''){
	$qry = "SELECT * FROM countries WHERE Id = '".$_POST['id']."'";
	$data = $modelObj->fetchRow($qry);
?>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script>
<form name="form_useradd" id="form_useradd" method="post" enctype="multipart/form-data" action="#" >
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%">
		<tr class="light_bg">
			<th>Country Name :</th>
			<td width="25%"><input type="text" class="input_box"  name="txt_country" id="txt_country" value="<?php echo stripslashes($data['name']) ?>" onblur="checkfield(this)" /><font class="required"> *</font></td>
			<td id="errortxt_country" width="55%">
            <label class="removerror error_new" id="error-innertxt_country"></label>
            </td>
		</tr>
       
			<td id="errortxt_timez">
            <label class="removerror error_new" id="error-innertxt_timez"></label>
            </td>
		</tr>
		<tr class="light_bg">
			<th>&nbsp;</th>
			<td valign="top">
			<?php 
			if($_POST['id'] !=0)
			{
			?>
				<input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data['id'] ?>" />
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
