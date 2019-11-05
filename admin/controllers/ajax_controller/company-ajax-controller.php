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
		$upload_dir =$_SESSION['SITE_IMG_PATH']."artist/";
		$upload_dirthumb =$_SESSION['SITE_IMG_PATH']."artist/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''){
		$id = $_POST['id'];
		$qry = "SELECT * FROM tbl_users where id = '".mysql_real_escape_string($id)."' and usertype=3";
		$result = $modelObj->fetchRow($qry);
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px"><tr class="white_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Ref Id:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['ref_id']) ?></td>
					  </tr><tr class="light_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>First Name:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['first_name']) ?></td>
					  </tr><tr class="white_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Last Name:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['last_name']) ?></td>
					  </tr><tr class="light_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Username:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['username']) ?></td>
					  </tr><tr class="white_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Emailid:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['emailid']) ?></td>
					  </tr><tr class="white_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Gender:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['gender']) ?></td>
					  </tr><?php $qry_country="SELECT * FROM tbl_country WHERE id='".$result['country']."'";
					$result_crty = $modelObj->fetchRow($qry_country); ?>
					<tr class="light_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Country:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo ucwords(stripslashes($result_crty['countryName'])) ?></td>
					  </tr><?php $qry_state="SELECT * FROM tbl_state WHERE id='".$result['state']."'";
					$result_state = $modelObj->fetchRow($qry_state); ?>
					<tr class="white_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>State:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo ucwords(stripslashes($result_state['stateName'])) ?></td>
					  </tr><?php $qry_city="SELECT * FROM tbl_city WHERE id='".$result['city']."'";
					$result_city = $modelObj->fetchRow($qry_city); ?>
					<tr class="light_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>City:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo ucwords(stripslashes($result_city['cityName'])) ?></td>
					  </tr><tr class="white_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Mobileno:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['mobileno']) ?></td>
					  </tr><tr class="light_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Image:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border">
                        	<?php if($result['image']):?>
                            	<img src="<?=$_SESSION['SITE_NAME']?>upload/artist/thumb/<?php echo stripslashes($result['image']) ?>" height="50" width="50" />
                            <?php endif;?></td>
					  </tr><tr class="white_bg">
						<td width="120" align="right" class="popup_listing_border"><strong>Usertype:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border">Company</td>
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
			$qry = "UPDATE  tbl_users SET status = 1 WHERE id = ".mysql_real_escape_string($val);
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
			$qry = "UPDATE  tbl_users SET status = 0 WHERE id = ".mysql_real_escape_string($val);
			$result =  $modelObj->runQuery($qry);
		}
	}
	?>
	<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id = explode("," ,$_POST['delete']);
		foreach($id as $k => $val)
		{
			$qry = "UPDATE  tbl_users SET status = 2 WHERE id = ".mysql_real_escape_string($val);
			$result =  $modelObj->runQuery($qry);
		}
	}
	?>
	<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){
		$qry = "SELECT * FROM tbl_users WHERE ref_id = '".mysql_real_escape_string(trim($_POST['txt_addref_id']))."' and status!=2 ";
		$result = $modelObj -> fetchRow($qry);
		
		if(strtolower(trim($result['ref_id'])) == strtolower(trim($_POST['txt_addref_id'])))
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
			}if(isset($_FILES["txt_addimage"]["tmp_name"]))
				{
					$tmpfile = $_FILES["txt_addimage"]["tmp_name"];
					$newname = $_FILES["txt_addimage"]["name"];				
					$insertimage="";
					if($_FILES["txt_addimage"]["tmp_name"] != '')
					{
						$abc=date("dmyHis");
						$insertimage=$abc.$newname;
						if(move_uploaded_file($tmpfile, $upload_dir.$insertimage))
						{
						  $resizeObj_20 = new resize($upload_dir.$insertimage); 
						  $resizeObj_20 -> resizeImage(50, 50, 'exact');
						  $resizeObj_20 -> saveImage($upload_dirthumb.$insertimage,$upload_dir.$insertimage, 100);
						}
					}
				}if(isset($_FILES["txt_addimage_limit"]["tmp_name"]))
				{
					$tmpfile = $_FILES["txt_addimage_limit"]["tmp_name"];
					$newname = $_FILES["txt_addimage_limit"]["name"];				
					$insertimage_limit="";
					if($_FILES["txt_addimage_limit"]["tmp_name"] != '')
					{
						$abc=date("dmyHis");
						$insertimage_limit=$abc.$newname;
						if(move_uploaded_file($tmpfile, $upload_dir.$insertimage_limit))
						{
						  $resizeObj_20 = new resize($upload_dir.$insertimage_limit); 
						  $resizeObj_20 -> resizeImage(50, 50, 'exact');
						  $resizeObj_20 -> saveImage($upload_dirthumb.$insertimage_limit,$upload_dir.$insertimage_limit, 100);
						}
					}
				}$qry = "INSERT INTO tbl_users (ref_id,first_name,last_name,username,emailid,password,gender,country,state,city,mobileno,image,plan_id,image_limit,usertype,cr_date,status) VALUES ('".clear_input($_POST['txt_addref_id'])."','".clear_input($_POST['txt_addfirst_name'])."','".clear_input($_POST['txt_addlast_name'])."','".clear_input($_POST['txt_addusername'])."','".clear_input($_POST['txt_addemailid'])."','".mysql_real_escape_string(trim(md5($_POST['txt_addpassword'])))."','".clear_input($_POST['txt_addgender'])."','".clear_input($_POST['txt_addcountry'])."','".clear_input($_POST['txt_addstate'])."','".clear_input($_POST['txt_addcity'])."','".clear_input($_POST['txt_addmobileno'])."','".$insertimage."','".clear_input($_POST['txt_addplan_id'])."','".$insertimage_limit."','".clear_input($_POST['txt_addusertype'])."',NOW(),1)";
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
		$qry = "UPDATE  tbl_users SET status = ".mysql_real_escape_string($_POST['status'])." WHERE id = ".mysql_real_escape_string($_POST['statusid']);
		$result =  $modelObj->runQuery($qry);
	}
	?>
	<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){
		$qry = "SELECT * FROM tbl_users WHERE ref_id = '".mysql_real_escape_string(trim($_POST['txt_addref_id']))."' and status!=2 and id != '".$_POST['hid_userid']."'";
		$result = $modelObj -> fetchRow($qry);
		
		if(strtolower(trim($result['ref_id'])) == strtolower(trim($_POST['txt_addref_id'])))
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
		{if(isset($_FILES["txt_addimage"]["tmp_name"]))
				{
					$tmpfile = $_FILES["txt_addimage"]["tmp_name"];
					$newname = $_FILES["txt_addimage"]["name"];
					$imgname='';
					
					if($_FILES["txt_addimage"]["tmp_name"] != '')
					{
						$abc=date("dmyHis");
						$imgname=$abc.$newname;
						if(move_uploaded_file($tmpfile, $upload_dir.$imgname))
						{
						  $resizeObj_20 = new resize($upload_dir.$imgname); 
						  $resizeObj_20 -> resizeImage(50, 50, 'exact');
						  $resizeObj_20 -> saveImage($upload_dirthumb.$imgname,$upload_dir.$imgname, 100);
						}
						$qry_img="UPDATE  tbl_users SET image='".$imgname."' where id='".mysql_real_escape_string($_POST['hid_userid'])."' ";
						$res_img= $modelObj->runQuery($qry_img);
					}
				}if(isset($_FILES["txt_addimage_limit"]["tmp_name"]))
				{
					$tmpfile = $_FILES["txt_addimage_limit"]["tmp_name"];
					$newname = $_FILES["txt_addimage_limit"]["name"];
					$imgname='';
					
					if($_FILES["txt_addimage_limit"]["tmp_name"] != '')
					{
						$abc=date("dmyHis");
						$imgname=$abc.$newname;
						if(move_uploaded_file($tmpfile, $upload_dir.$imgname))
						{
						  $resizeObj_20 = new resize($upload_dir.$imgname); 
						  $resizeObj_20 -> resizeImage(50, 50, 'exact');
						  $resizeObj_20 -> saveImage($upload_dirthumb.$imgname,$upload_dir.$imgname, 100);
						}
						$qry_img="UPDATE  tbl_users SET image_limit='".$imgname."' where id='".mysql_real_escape_string($_POST['hid_userid'])."' ";
						$res_img= $modelObj->runQuery($qry_img);
					}
				}$qry = "UPDATE tbl_users SET ref_id = '".clear_input($_POST['txt_addref_id'])."',first_name = '".clear_input($_POST['txt_addfirst_name'])."',last_name = '".clear_input($_POST['txt_addlast_name'])."',username = '".clear_input($_POST['txt_addusername'])."',emailid = '".clear_input($_POST['txt_addemailid'])."',gender = '".clear_input($_POST['txt_addgender'])."',country = '".clear_input($_POST['txt_addcountry'])."',state = '".clear_input($_POST['txt_addstate'])."',city = '".clear_input($_POST['txt_addcity'])."',mobileno = '".clear_input($_POST['txt_addmobileno'])."',plan_id = '".clear_input($_POST['txt_addplan_id'])."',usertype = '".clear_input($_POST['txt_addusertype'])."'WHERE id = '".mysql_real_escape_string($_POST['hid_userid'])."'";
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
		{if(trim($_POST['txt_srcref_id']) != '')
						{
							$searchqry .="and ref_id LIKE '%".mysql_real_escape_string(trim($_POST['txt_srcref_id']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}if(trim($_POST['txt_srcfirst_name']) != '')
						{
							$searchqry .="and first_name LIKE '%".mysql_real_escape_string(trim($_POST['txt_srcfirst_name']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}if(trim($_POST['txt_srclast_name']) != '')
						{
							$searchqry .="and last_name LIKE '%".mysql_real_escape_string(trim($_POST['txt_srclast_name']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}if(trim($_POST['txt_srcusername']) != '')
						{
							$searchqry .="and username LIKE '%".mysql_real_escape_string(trim($_POST['txt_srcusername']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}if(trim($_POST['txt_srcemailid']) != '')
						{
							$searchqry .="and emailid LIKE '%".mysql_real_escape_string(trim($_POST['txt_srcemailid']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}if(trim($_POST['txt_srcgender']) != '')
						{
							$searchqry .="and gender LIKE '%".mysql_real_escape_string(trim($_POST['txt_srcgender']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}if(trim($_POST['txt_srcmobileno']) != '')
						{
							$searchqry .="and mobileno LIKE '%".mysql_real_escape_string(trim($_POST['txt_srcmobileno']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}if(trim($_POST['txt_srcplan_id']) != '')
						{
							$searchqry .="and plan_id LIKE '%".mysql_real_escape_string(trim($_POST['txt_srcplan_id']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}if(trim($_POST['txt_srcusertype']) != '')
						{
							$searchqry .="and usertype LIKE '%".mysql_real_escape_string(trim($_POST['txt_srcusertype']))."%'";
							$_SESSION['srchqry'] =  $searchqry; 
						}$_SESSION['srchqry'] =  $_SESSION['srchqry']; 
			
			if($_POST['fieldname'] == '0')
			{
				$qry = "SELECT * FROM tbl_users where status!=2 and usertype=3 ".$_SESSION['srchqry']." order by cr_date desc LIMIT $start,$end ";
			}
			else
			{
				$qry = "SELECT * FROM tbl_users where status!=2 and usertype=3 ".$_SESSION['srchqry']." ORDER BY ".$_POST['fieldname']." ".$orderby." LIMIT $start,$end";
			}
			$qry11 = mysql_query("SELECT * FROM tbl_users where status!=2 and usertype=3 ".$_SESSION['srchqry']."")or die(mysql_error());
		}
		else
		{
			if($_POST['fieldname'] == '0')
			{
				$qry = "SELECT * FROM tbl_users where status!=2 and usertype=3 order by cr_date desc LIMIT $start,$end ";
			}
			else
			{
				$qry = "SELECT * FROM tbl_users where status!=2 and usertype=3 ORDER BY ".$_POST['fieldname']." ".$orderby." LIMIT $start,$end";
			}	  
			$qry11 = mysql_query("SELECT * FROM tbl_users where status!=2 and usertype=3 ")or die(mysql_error());
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
		$('#form_companyview input[type=checkbox]').checkBox('toggle');
		return false;
		});
	});
	</script> 
	<form id="form_companyview" action="" name="form_companyview" method="post" enctype="multipart/form-data" onsubmit="return false">
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
		  <th class="table-header-check"><a id="toggle-all" ></a> </th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('ref_id','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="ref_id" class="cursorpointer">Ref Id</a></th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('first_name','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="first_name" class="cursorpointer">First Name</a></th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('last_name','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="last_name" class="cursorpointer">Last Name</a></th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('username','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="username" class="cursorpointer">Username</a></th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('emailid','<?php if($orderby=='asc'){echo "desc";}else{echo "asc";} ?>')" id="emailid" class="cursorpointer">Emailid</a></th><th class="table-header-options line-left"><a>Options</a></th>
		</tr>
	<?php
	$i = 0;
	if($result != ''){
		foreach($result  as $k => $data){
		$i++;
	?>
		<tr id="<?php echo $data['id']?>" class="<?php if($i%2==0){ echo "light_bg"; }else{ echo "white_bg"; } ?>" height="30">
			<td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['id'];  ?>"/></td><td class="cursorpointer" onclick="edit('<?php echo $data['id'] ?>','<?php echo $_SESSION['pid']?>')"><?php echo stripslashes($data['ref_id']); ?></td><td><?php echo stripslashes($data['first_name']); ?></td><td><?php echo stripslashes($data['last_name']); ?></td><td><?php echo stripslashes($data['username']); ?></td><td><?php echo stripslashes($data['emailid']); ?></td><td class="options-width" >
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
						<!--<td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['id'] ?>','<?php echo $_SESSION['pid']?>')"></a></td>-->
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
			  <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No company found."; ?></strong></td>
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
			$qry = "UPDATE tbl_users SET status = 2 WHERE id = '".$_POST['id']."'";
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
		$qry = "SELECT * FROM tbl_users WHERE id = '".$_POST['id']."'";
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
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script><form name="form_companyadd" id="form_companyadd" method="post" enctype="multipart/form-data" action="#" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%"><tr class="white_bg">
						<th>First Name : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_addfirst_name" id="txt_addfirst_name" value="<?php echo stripslashes($data['first_name']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addfirst_name" width="57%">
						<label class="removerror error_new" id="error-innertxt_addfirst_name"></label>
						</td>
					</tr><tr class="light_bg">
						<th>Last Name : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_addlast_name" id="txt_addlast_name" value="<?php echo stripslashes($data['last_name']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addlast_name" width="57%">
						<label class="removerror error_new" id="error-innertxt_addlast_name"></label>
						</td>
					</tr><tr class="white_bg">
						<th>Username : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_addusername" id="txt_addusername" value="<?php echo stripslashes($data['username']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addusername" width="57%">
						<label class="removerror error_new" id="error-innertxt_addusername"></label>
						</td>
					</tr><tr class="light_bg">
						<th>Emailid : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_addemailid" id="txt_addemailid" value="<?php echo stripslashes($data['emailid']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addemailid" width="57%">
						<label class="removerror error_new" id="error-innertxt_addemailid"></label>
						</td>
					</tr><?php
					if($_POST['id']=='0'){
					?><tr class="white_bg">
						<th>Password : </th>
						<td width="23%">
						<input class="input_box" type="password" name="txt_addpassword" id="txt_addpassword" value="<?php echo $data['password'] ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addpassword" width="57%">
						<label class="removerror error_new" id="error-innertxt_addpassword"></label>
						</td>
					</tr><tr class="white_bg">
						<th>Confirm Password : </th>
						<td width="23%">
						<input class="input_box" type="password" name="txt_addcpassword" id="txt_addcpassword" value="<?php echo $data['password'] ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addcpassword" width="57%">
						<label class="removerror error_new" id="error-innertxt_addcpassword"></label>
						</td>
					</tr><?php
					}
					?><tr class="light_bg">
						<th>Gender : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_addgender" id="txt_addgender" value="<?php echo stripslashes($data['gender']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addgender" width="57%">
						<label class="removerror error_new" id="error-innertxt_addgender"></label>
						</td>
					</tr><tr class="white_bg">
					<th>Country : </th>
					<td width="23%">
						<select class="select_box" name="txt_addcountry" id="txt_addcountry" onblur="checkfield(this)" onchange="getStates()">
							<option value="">Select Country</option>
							<?php
								if($result_crty != '')
								{
									foreach($result_crty  as $k => $data1)
									{
										if($data['country']==$data1['id'])
										{
											echo "<option selected='selected' value='".$data1['id']."'>".ucwords(stripslashes($data1['countryName']))."</option>";
										}
										else
										{
											echo "<option value=".$data1['id'].">".ucwords(stripslashes($data1['countryName']))."</option>";
										}
									}
								}
							?>
						</select><font class="required"> *</font>
					</td>
					<td id="errortxt_addcountry" width="57%">
					<label class="removerror error_new" id="error-innertxt_addcountry"></label>
					</td>
				</tr><tr class="light_bg">
					<th>State : </th>
					<td id="stateajax" width="23%">
						<select class="select_box"  name="txt_addstate" id="txt_addstate" onblur="checkfield(this)" onchange="getCities()">
							<option value="">Select State</option>
							<?php
								if($result_state != '')
								{
									foreach($result_state  as $k => $data1)
									{
										if($data['state']==$data1['id'])
										{
											echo "<option selected='selected' value='".$data1['id']."'>".ucwords(stripslashes($data1['stateName']))."</option>";
										}
										else if($data['country']==$data1['countryId'])
										{
											echo "<option value='".$data1['id']."'>".ucwords(stripslashes($data1['stateName']))."</option>";
										}
									}
								}
							?>
						</select><font class="required"> *</font>
					</td>
					<td id="errortxt_addstate" width="57%">
					<label class="removerror error_new" id="error-innertxt_addstate"></label>
					</td>
				</tr><tr class="white_bg">
					<th>City : </th>
					<td id="cityajax" width="23%">
						<select class="select_box"  name="txt_addcity" id="txt_addcity" onblur="checkfield(this)" onchange="getZipCode()">
							<option value="">Select City</option>
							<?php
								if($result_city != '')
								{
									foreach($result_city  as $k => $data1)
									{
										if($data['city']==$data1['id'])
										{
											echo "<option selected='selected' value='".$data1['id']."'>".ucwords(stripslashes($data1['cityName']))."</option>";
										}
										else if($data['state']==$data1['stateId'])
										{
											echo "<option value='".$data1['id']."'>".ucwords(stripslashes($data1['cityName']))."</option>";
										}
									}
								}
							?>
						</select><font class="required"> *</font>
						<td id="errortxt_addcity" width="57%">
						<label class="removerror error_new" id="error-innertxt_addcity"></label>
						</td>
					</tr><tr class="light_bg">
						<th>Mobileno : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_addmobileno" id="txt_addmobileno" value="<?php echo stripslashes($data['mobileno']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addmobileno" width="57%">
						<label class="removerror error_new" id="error-innertxt_addmobileno"></label>
						</td>
					</tr><tr class="white_bg">
						<th>Image : </th>
						<td width="23%">
						<input type="file" class="input_box" name="txt_addimage" id="txt_addimage" size="16" />
						</td>
						<td id="errortxt_addimage" width="57%">
						<img src="<?=$LOCATION['SITE_ADMIN']?>upload/image/thumb/<?php echo $data['image'] ?>" height="50" width="50" />
						<label class="removerror error_new" id="error-innertxt_addimage"></label>
						</td>
					</tr><tr class="light_bg">
						<th>Plan Id : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_addplan_id" id="txt_addplan_id" value="<?php echo stripslashes($data['plan_id']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addplan_id" width="57%">
						<label class="removerror error_new" id="error-innertxt_addplan_id"></label>
						</td>
					</tr><tr class="white_bg">
						<th>Image Limit : </th>
						<td width="23%">
						<input type="file" class="input_box" name="txt_addimage_limit" id="txt_addimage_limit" size="16" />
						</td>
						<td id="errortxt_addimage_limit" width="57%">
						<img src="<?=$LOCATION['SITE_ADMIN']?>upload/image/thumb/<?php echo $data['image_limit'] ?>" height="50" width="50" />
						<label class="removerror error_new" id="error-innertxt_addimage_limit"></label>
						</td>
					</tr><tr class="light_bg">
						<th>Usertype : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_addusertype" id="txt_addusertype" value="<?php echo stripslashes($data['usertype']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addusertype" width="57%">
						<label class="removerror error_new" id="error-innertxt_addusertype"></label>
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
	<select class="select_box"  name="txt_addstate" id="txt_addstate" onblur="checkfield(this)" onchange="getCities()">
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
	<select class="select_box"  name="txt_addcity" id="txt_addcity" onblur="checkfield(this)" onchange="getZipCode()">
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