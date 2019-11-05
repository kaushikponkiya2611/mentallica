<?php 
		@session_start();
		include('../../models/db.php');
		include('../../models/common-model.php');
		include('../../includes/thumb_new.php');
		include('../../includes/resize-class.php');
		include('../common-controller.php');
		$database = new Connection();
		include('../../models/ajax-model.php');
		$modelObj = new AjaxModel();
		$upload_dir =$_SERVER['SITE_IMG_PATH']."upload/image/";
		$upload_dirthumb =$_SERVER['SITE_IMG_PATH']."upload/image/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''){
		$id = $_POST['id'];
		$qry = "SELECT * FROM tbl_suggested_artist where id = '".mysql_real_escape_string($id)."'";
		$result = $modelObj->fetchRow($qry);
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px"><tr class="white_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Aid:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['aid']) ?></td>
					  </tr></table>
	<?php 
	} 
	?>			
	<?php
	if(isset($_POST['statusactive']) && $_POST['statusactive'] != '')
	{
		$id = explode("," ,$_POST['active']);
		foreach($id as $k => $val)
		{
			$qry = "UPDATE  tbl_suggested_artist SET status = 1 WHERE id = ".mysql_real_escape_string($val);
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
			$qry = "UPDATE  tbl_suggested_artist SET status = 0 WHERE id = ".mysql_real_escape_string($val);
			$result =  $modelObj->runQuery($qry);
		}
	}
	?>
	<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id = explode("," ,$_POST['delete']);
		foreach($id as $k => $val)
		{
			$qry = "UPDATE  tbl_suggested_artist SET status = 2 WHERE id = ".mysql_real_escape_string($val);
			$result =  $modelObj->runQuery($qry);
		}
	}
	?>
	<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){
		$qry = "SELECT * FROM tbl_suggested_artist WHERE aid = '".mysql_real_escape_string(trim($_POST['txt_addaid']))."' and status!=2 ";
		$result = $modelObj -> fetchRow($qry);
		
		
			$flag = 1;
		
		
		if($flag == 1)
		{
			
			$dqlqry = "DELETE FROM tbl_suggested_artist where cid=".$_REQUEST['txt_category'];
			$modelObj->runQuery($dqlqry);
			foreach($_POST['txt_addaid'] as $valid){
				
			$qry = "INSERT INTO tbl_suggested_artist (aid,cid,cr_date,status) VALUES ('".clear_input($valid)."','".clear_input($_REQUEST['txt_category'])."',NOW(),1)";
			$result = $modelObj->runQuery($qry);
			
			}
			
			echo "1";
	   }
	   else
	   {
		 echo "0";
	   }
	}
	?>
	<?php
	if(isset($_POST['statusid']) && $_POST['statusid'] != ''){
		$qry = "UPDATE  tbl_suggested_artist SET status = ".mysql_real_escape_string($_POST['status'])." WHERE id = ".mysql_real_escape_string($_POST['statusid']);
		$result =  $modelObj->runQuery($qry);
	}
	?>
	<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){
		$qry = "SELECT * FROM tbl_suggested_artist WHERE aid = '".mysql_real_escape_string(trim($_POST['txt_addaid']))."' and status!=2 and id != '".$_POST['hid_userid']."'";
		$result = $modelObj -> fetchRow($qry);
		
		if(strtolower(trim($result['aid'])) == strtolower(trim($_POST['txt_addaid'])))
		{
			echo $errmsg = "0";
			$flag = 0;
		}
		else
		{
			$flag = 1;
		}
		$flag = 1;
		
		if($flag == 1)
		{$qry = "UPDATE tbl_suggested_artist SET aid = '".clear_input($_POST['txt_addaid'])."'WHERE id = '".mysql_real_escape_string($_POST['hid_userid'])."'";
			$result = $modelObj->runQuery($qry);
			echo "1";
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
		{if(trim($_POST['txt_srcaid']) != '')
						{
							$searchqry .="and aid LIKE '%".mysql_real_escape_string(trim($_POST['txt_srcaid']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}$_SESSION['srchqry'] =  $_SESSION['srchqry']; 
			
			if($_POST['fieldname'] == '0')
			{
				$qry = "SELECT * FROM tbl_suggested_artist where status!=2 ".$_SESSION['srchqry']." order by cr_date desc LIMIT $start,$end ";
			}
			else
			{
				$qry = "SELECT * FROM tbl_suggested_artist where status!=2 ".$_SESSION['srchqry']." ORDER BY ".$_POST['fieldname']." ".$orderby." LIMIT $start,$end";
			}
			$qry11 = mysql_query("SELECT * FROM tbl_suggested_artist where status!=2 ".$_SESSION['srchqry']."")or die(mysql_error());
		}
		else
		{
			if($_POST['fieldname'] == '0')
			{
				$qry = "SELECT * FROM tbl_suggested_artist where status!=2 order by cr_date desc LIMIT $start,$end ";
			}
			else
			{
				$qry = "SELECT * FROM tbl_suggested_artist where status!=2 ORDER BY ".$_POST['fieldname']." ".$orderby." LIMIT $start,$end";
			}	  
			$qry11 = mysql_query("SELECT * FROM tbl_suggested_artist where status!=2 ")or die(mysql_error());
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
		$('#form_artist_suggestedview input[type=checkbox]').checkBox('toggle');
		return false;
		});
	});
	</script> 
	<form id="form_artist_suggestedview" action="" name="form_artist_suggestedview" method="post" enctype="multipart/form-data" onsubmit="return false">
	 
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
		<tr>
		   <th class="table-header-repeat line-left minwidth-1">Category</th> 
			  <th class="table-header-repeat line-left minwidth-1">Suggested Artist</th> 
		</tr>
	<?php
	$i = 0;
	if($result != ''){
		foreach($result  as $k => $data){
		$i++;
		$qrya = mysql_query("SELECT * FROM tbl_users where id=".$data['aid']);
				$result_usera = mysql_fetch_array($qrya);
				
				$qryac = mysql_query("SELECT * FROM tbl_category where id=".$data['cid']);
				$result_cat = mysql_fetch_array($qryac);
	?>
		<tr id="<?php echo $data['id']?>" class="<?php if($i%2==0){ echo "light_bg"; }else{ echo "white_bg"; } ?>" height="30">
		<td><?php echo $result_cat['categoryName']; ?></td>
			<td><?php echo $result_usera['first_name']." ".$result_usera['last_name']."(".$result_usera['username'].")"; ?></td> 
		</tr>
		<?php 
			} 
		 }
		 else
		 { 
		 ?>
			 <tr height="30">
			  <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No artist_suggested found."; ?></strong></td>
			</tr>
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
			$qry = "UPDATE tbl_suggested_artist SET status = 2 WHERE id = '".$_POST['id']."'";
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
			?>
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script><form name="form_artist_suggestedadd" id="form_artist_suggestedadd" method="post" enctype="multipart/form-data" action="#" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%">
		<tr class="light_bg">
			<th>Category Name :</th>
			<td width="25%">
				<select class="select_box"  name="txt_category" id="txt_category" onblur="checkfield(this)" onchange="getSuggestedArtist()">
					<option value="">---Select Category---</option>
					<?php
						$qry_country="SELECT * FROM tbl_category WHERE status=1 order by categoryName asc";
						$result_crty = $modelObj->fetchRows($qry_country);
						if($result_crty != '')
						{
							foreach($result_crty  as $k => $data1)
							{
								 
									echo "<option value=".$data1['id'].">".stripslashes($data1['categoryName'])."</option>";
								 
							}
						}
					?> 
			</td> 
		</tr>
		<tr id="suggartistdiv">
		<td colspan="3"></td>
			</tr>	
					<tr class="light_bg">
				<th>&nbsp;</th>
				<td valign="top">

					<input type="hidden" name="hid_add" id="hid_add" value="add" />
					<input class="button_bg" type="submit" value="Submit" name="btn_save" onclick="return adddata()">
					<input class="button_bg" type="button" value="Cancel" name="btn_cancel" onclick="newdata()">
				
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
	<select class="select_box"  name="" id="" onblur="checkfield(this)" onchange="getCities()">
		<option value="">Select State</option>
		<?php
			if($result_s != '')
			{
				foreach($result_s  as $k => $data1)
				{
					echo "<option value=".$data1['id'].">".ucwords(stripslashes($data1['stateName']))."</option>";
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
	<select class="select_box"  name="" id="" onblur="checkfield(this)" onchange="getZipCode()">
		<option value="">Select City</option>
		<?php
			if($result_s != '')
			{
				foreach($result_s  as $k => $data1)
				{
					echo "<option value=".$data1['id'].">".ucwords(stripslashes($data1['cityName']))."</option>";
				}
			}
		?>
	</select><font class="required"> *</font>
	<?php
	}
	?>
	<?php 
	if(isset($_POST['getzcodeid'])){
	$qry_s="SELECT * FROM tbl_zipcode WHERE status =1 and cityId='".$_POST['getzcodeid']."' order by zipCode asc";
	$result_s = $modelObj->fetchRows($qry_s);
	?>
	<select class="select_box"  name="" id="" onblur="checkfield(this)">
		<option value="">Select Zipcode</option>
		<?php
			if($result_s != '')
			{
				foreach($result_s  as $k => $data1)
				{
					echo "<option value=".$data1['id'].">".ucwords(stripslashes($data1['zipCode']))."</option>";
				}
			}
		?>
	</select><font class="required"> *</font>
	<?php
	}
	?>