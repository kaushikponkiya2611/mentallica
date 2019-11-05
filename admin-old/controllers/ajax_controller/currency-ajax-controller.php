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
		$qry = "SELECT * FROM tbl_currency where id = '".mysql_real_escape_string($id)."'";
		$result = $modelObj->fetchRow($qry);
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px"><tr class="white_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Cur Code:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['cur_code']) ?></td>
					  </tr><tr class="light_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Cur Text:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['cur_text']) ?></td>
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
			$qry = "UPDATE  tbl_currency SET status = 1 WHERE id = ".mysql_real_escape_string($val);
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
			$qry = "UPDATE  tbl_currency SET status = 0 WHERE id = ".mysql_real_escape_string($val);
			$result =  $modelObj->runQuery($qry);
		}
	}
	?>
	<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id = explode("," ,$_POST['delete']);
		foreach($id as $k => $val)
		{
			$qry = "UPDATE  tbl_currency SET status = 2 WHERE id = ".mysql_real_escape_string($val);
			$result =  $modelObj->runQuery($qry);
		}
	}
	?>
	<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){
		$qry = "SELECT * FROM tbl_currency WHERE cur_code = '".mysql_real_escape_string(trim($_POST['txt_addcur_code']))."' and status!=2 ";
		$result = $modelObj -> fetchRow($qry);
		
		if(strtolower(trim($result['cur_code'])) == strtolower(trim($_POST['txt_addcur_code'])))
		{
			$flag = 0;
		}
		else
		{
			$flag = 1;
		}
		
		if($flag == 1)
		{
			if(!dir($upload_dir))
			{
				mkdir($upload_dir);
			}
			if(!dir($upload_dirthumb))
			{
				mkdir($upload_dirthumb);
			}$qry = "INSERT INTO tbl_currency (cur_code,cur_text,cr_date,status) VALUES ('".clear_input($_POST['txt_addcur_code'])."','".clear_input($_POST['txt_addcur_text'])."',NOW(),1)";
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
	if(isset($_POST['statusid']) && $_POST['statusid'] != ''){
		$qry = "UPDATE  tbl_currency SET status = ".mysql_real_escape_string($_POST['status'])." WHERE id = ".mysql_real_escape_string($_POST['statusid']);
		$result =  $modelObj->runQuery($qry);
	}
	?>
	<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){
		$qry = "SELECT * FROM tbl_currency WHERE cur_code = '".mysql_real_escape_string(trim($_POST['txt_addcur_code']))."' and status!=2 and id != '".$_POST['hid_userid']."'";
		$result = $modelObj -> fetchRow($qry);
		
		if(strtolower(trim($result['cur_code'])) == strtolower(trim($_POST['txt_addcur_code'])))
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
		{$qry = "UPDATE tbl_currency SET cur_code = '".clear_input($_POST['txt_addcur_code'])."',cur_text = '".clear_input($_POST['txt_addcur_text'])."'WHERE id = '".mysql_real_escape_string($_POST['hid_userid'])."'";
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
		{if(trim($_POST['txt_srccur_code']) != '')
						{
							$searchqry .="and cur_code LIKE '%".mysql_real_escape_string(trim($_POST['txt_srccur_code']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}if(trim($_POST['txt_srccur_text']) != '')
						{
							$searchqry .="and cur_text LIKE '%".mysql_real_escape_string(trim($_POST['txt_srccur_text']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}$_SESSION['srchqry'] =  $_SESSION['srchqry']; 
			
			if($_POST['fieldname'] == '0')
			{
				$qry = "SELECT * FROM tbl_currency where status!=2 ".$_SESSION['srchqry']." order by cr_date desc LIMIT $start,$end ";
			}
			else
			{
				$qry = "SELECT * FROM tbl_currency where status!=2 ".$_SESSION['srchqry']." ORDER BY ".$_POST['fieldname']." ".$orderby." LIMIT $start,$end";
			}
			$qry11 = mysql_query("SELECT * FROM tbl_currency where status!=2 ".$_SESSION['srchqry']."")or die(mysql_error());
		}
		else
		{
			if($_POST['fieldname'] == '0')
			{
				$qry = "SELECT * FROM tbl_currency where status!=2 order by cr_date desc LIMIT $start,$end ";
			}
			else
			{
				$qry = "SELECT * FROM tbl_currency where status!=2 ORDER BY ".$_POST['fieldname']." ".$orderby." LIMIT $start,$end";
			}	  
			$qry11 = mysql_query("SELECT * FROM tbl_currency where status!=2 ")or die(mysql_error());
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
		$('#form_currencyview input[type=checkbox]').checkBox('toggle');
		return false;
		});
	});
	</script> 
	<form id="form_currencyview" action="" name="form_currencyview" method="post" enctype="multipart/form-data" onsubmit="return false">
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
		  <th class="table-header-check"><a id="toggle-all" ></a> </th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('cur_code','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="cur_code" class="cursorpointer">Cur Code</a></th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('cur_text','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="cur_text" class="cursorpointer">Cur Text</a></th><th class="table-header-options line-left"><a>Options</a></th>
		</tr>
	<?php
	$i = 0;
	if($result != ''){
		foreach($result  as $k => $data){
		$i++;
	?>
		<tr id="<?php echo $data['id']?>" class="<?php if($i%2==0){ echo "light_bg"; }else{ echo "white_bg"; } ?>" height="30">
			<td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['id'];  ?>"/></td><td class="cursorpointer" onclick="edit('<?php echo $data['id'] ?>','<?php echo $_SESSION['pid']?>')"><?php echo stripslashes($data['cur_code']); ?></td><td><?php echo stripslashes($data['cur_text']); ?></td><td class="options-width" >
				<table>
					<tr>
						<td>
							<?php
							if($data['status'] == '1')
							{
							?>
							<div id="d_<?=$data['id']?>">
							<a id="s_<?=$data['id']?>" style="cursor:pointer;" title="Active" class="icon-active info-tooltip" onclick="changeStatus('<?=$data['id']?>');"></a>
							</div>
							<input type="hidden" id="status_<?=$data['id']?>" name="status_<?=$data['id']?>" value="Active" />						
							<?php
							}
							else
							{
							?>
							<div id="d_<?=$data['id']?>">
							<a id="s_<?=$data['id']?>" style="cursor:pointer;" title="Inactive" class="icon-inactive info-tooltip" onclick="changeStatus('<?=$data['id']?>');"></a>
							</div>
							<input type="hidden" id="status_<?=$data['id']?>" name="status_<?=$data['id']?>" value="Inactive" />						
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
			 <tr height="30">
			  <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No currency found."; ?></strong></td>
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
			$qry = "UPDATE tbl_currency SET status = 2 WHERE id = '".$_POST['id']."'";
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
		$qry = "SELECT * FROM tbl_currency WHERE id = '".$_POST['id']."'";
		$data = $modelObj->fetchRow($qry);
		$qry_country="SELECT * FROM tbl_country WHERE status=1 order by countryName asc";
		$result_crty = $modelObj->fetchRows($qry_country);
		$qry_state="SELECT * FROM tbl_state WHERE status=1 order by stateName asc";
		$result_state= $modelObj->fetchRows($qry_state);
		$qry_city="SELECT * FROM tbl_city WHERE status=1 order by cityName asc";
		$result_city = $modelObj->fetchRows($qry_city);
		$qry_zcode="SELECT * FROM tbl_zipcode WHERE status=1 order by zipCode asc";
		$result_zcode = $modelObj->fetchRows($qry_zcode);
	?>
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script><form name="form_currencyadd" id="form_currencyadd" method="post" enctype="multipart/form-data" action="#" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%"><tr class="white_bg">
						<th>Cur Code : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_addcur_code" id="txt_addcur_code" value="<?php echo stripslashes($data['cur_code']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addcur_code" width="57%">
						<label class="removerror error_new" id="error-innertxt_addcur_code"></label>
						</td>
					</tr><tr class="light_bg">
						<th>Cur Text : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_addcur_text" id="txt_addcur_text" value="<?php echo stripslashes($data['cur_text']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addcur_text" width="57%">
						<label class="removerror error_new" id="error-innertxt_addcur_text"></label>
						</td>
					</tr><tr class="white_bg">
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