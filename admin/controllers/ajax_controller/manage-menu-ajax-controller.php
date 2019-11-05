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
	$upload_dir =$_SESSION['SITE_IMG_PATH']."images/menu/";
?>
<?php
if(isset($_POST['view']) && $_POST['view'] != ''){
    $id = $_POST['id'];
	$qry = "select * from tbl_section where Section_Id='".$id."'";
	$result = $modelObj->fetchRow($qry);
	
	$qry_submenu = "select * from tbl_sectionlink where Section_Id='".$id."'";
	$result_submenu = $modelObj->fetchRows($qry_submenu);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px">
      <tr class="light_bg">
        <td width="120" align="right" class="popup_listing_border"><strong>Section Name:</strong></td>
        <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td width="469" align="left" class="popup_listing_border"><?php echo $result['Name'] ?></td>
      </tr>
      <tr class="white_bg">
        <td align="right" class="popup_listing_border"><strong>Order Number.:</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border"><?php echo $result['Order_no'] ?></td>
      </tr>
	   <tr class="light_bg">
        <td align="right" class="popup_listing_border"><strong>Sub Section :</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border">
		<div style="width:100%">
			<div style="float:left;width:60%"><strong>Title</strong></div>
			<div style="float:left;width:40%"><strong>Order Number</strong></div>
		</div>
		</td>
      </tr>
		<?php 
		foreach($result_submenu as $k => $data)
		{
		?>
	   <tr class="light_bg">
        <td align="right" class="popup_listing_border"><strong>&nbsp;</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border">
		<div style="width:100%">
			<div style="float:left;width:70%"><?=$data['Title']?></div>
			<div style="float:left;width:30%"><?=$data['Order_no']?></div>
		</div>
		</td>
      </tr>
		<?php
		}
		?>
</table>
<?php 
} 
?>


<?php
if(isset($_POST['statusactive']) && $_POST['statusactive'] != '')
{
	$id = explode("," ,$_POST['active']);
	foreach($id as $k => $val)
	{
		$qry = "UPDATE tbl_section SET status = 1 WHERE Section_Id = ".mysql_real_escape_string($val);
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
		$qry = "UPDATE  tbl_section  SET status = 0 WHERE Section_Id = ".mysql_real_escape_string($val);
		$result =  $modelObj->runQuery($qry);
	}
}
?>
<?php
if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
	$id = explode("," ,$_POST['delete']);
	foreach($id as $k => $val)
	{
		$qry = "UPDATE  tbl_section SET status = 2 WHERE Section_Id = ".mysql_real_escape_string($val);
		$result =  $modelObj->runQuery($qry);
	}
}
?>
<?php
if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){
	$qry = "SELECT * FROM tbl_section WHERE Name = '".mysql_real_escape_string(trim($_POST['txt_sectionname']))."' and Link='".mysql_real_escape_string(trim($_POST['txt_pageid']))."' and status!=2 ";
	$result = $modelObj -> fetchRow($qry);
	
	if(strtolower(trim($result['Name'])) == strtolower(trim($_POST['txt_sectionname'])))
	{
		$flag = 0;
	}
	else
	{
		$flag = 1;
	}
	
	if($flag == 1)
	{
		$tmpfile = $_FILES["txt_logo"]["tmp_name"];
		$newname = $_FILES["txt_logo"]["name"];
		$imgname='default.png';
		
		if($_FILES['txt_logo']['tmp_name'] != '')
		{
			$abc=date("dmyHis");
			$imgname=$abc.$newname;
			if(move_uploaded_file($tmpfile, $upload_dir.$imgname))
			{
			  $resizeObj_20 = new resize($upload_dir.$imgname); 
			  $resizeObj_20 -> resizeImage(32, 32, 'exact');
			  $resizeObj_20 -> saveImage($upload_dir.$imgname,$upload_dir.$imgname, 100);
			}
		}
		
		$qry = "INSERT INTO tbl_section (Name,Order_no,Link,status,Image,page_name,section_name) 
		VALUES ('".clear_input($_POST['txt_sectionname'])."',
		'".clear_input($_POST['txt_sectionorder'])."',
		'".clear_input($_POST['txt_pageid'])."',1,
		'".$imgname."',
		'".($_POST['txt_pagename'])."',
		'".($_POST['txt_headername'])."')";
		$result = $modelObj->runQuery($qry);
		$lastId=mysql_insert_id();
		
		$mainpageid=strtolower($_POST['txt_pageid']);
		if($_POST['combo_tables']=="")
		{
			$createtable="CREATE TABLE tbl_".$mainpageid." (
				id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				".$mainpageid."_1 VARCHAR( 50 ) NOT NULL ,
				".$mainpageid."_2 VARCHAR( 50 ) NOT NULL ,
				".$mainpageid."_3 VARCHAR( 50 ) NOT NULL ,
				".$mainpageid."_4 VARCHAR( 50 ) NOT NULL ,
				cr_date DATETIME NOT NULL ,
				status INT( 11 ) NOT NULL
				) ENGINE = InnoDB;";
			$result_createtable = $modelObj->runQuery($createtable);
			$_POST['combo_tables']="tbl_".$mainpageid;
		}
		$mytables=$_POST['combo_tables'];
		$qry_desctable="Desc ".$_POST['combo_tables']."";	
		$result_desctable = $modelObj -> fetchRows($qry_desctable);	
		$myarray=array();
		$countryy="no";
		$states="no";
		$cityy="no";
		$zipp="no";
		foreach($result_desctable as $k => $values)
		{
			if($values['Field'] != 'id' && $values['Field'] != 'cr_date' && $values['Field'] != 'status')
			{
				$myarray[]=$values;
			}
			if(preg_match("/country/i", $values['Field']))
			{
				$countryy="yes";
				$countryy_name="txt_add".$values['Field'];
			}
			if(preg_match("/state/i", $values['Field']))
			{
				$states="yes";
				$states_name="txt_add".$values['Field'];
			}
			if(preg_match("/city/i", $values['Field']))
			{
				$cityy="yes";
				$cityy_name="txt_add".$values['Field'];
			}
			if(preg_match("/zip/i", $values['Field']))
			{
				$zipp="yes";
				$zipp_name="txt_add".$values['Field'];
			}
		}
		$totalrecord=count($myarray);
		include('../ajax_controller/viewcommon.php');
		include('../ajax_controller/javascriptcommon.php');
		include('../ajax_controller/modelcommon.php');
		include('../ajax_controller/controllercommon.php');
		include('../ajax_controller/ajaxcontrollercommon.php');		
		
		$cntquestion = count($_POST['txt_subsection']);
		for($i=0;$i<$cntquestion;$i++)
		{
			$p_question = $_POST['txt_subsection'];
			$final_question =$p_question[$i];
			
			$p_marks = $_POST['txt_subsectionorder'];
			$final_marks =$p_marks[$i];
			
			$p_link = $_POST['txt_subpageid'];
			$final_link =$p_link[$i];
			
			$p_title = $_POST['txt_subpagetitle'];
			$final_title =$p_title[$i];
			
			$p_htitle = $_POST['txt_subheadertitle'];
			$final_htitle =$p_htitle[$i];
			
			$p_tables = $_POST['combo_subtables'];
			$final_tables =$p_tables[$i];			
			
			$tmpfile = $_FILES["txt_sublogo"]["tmp_name"][$i];
			$newname = $_FILES["txt_sublogo"]["name"][$i];
			$imgname='default.png';
			
			if($_FILES['txt_sublogo']['tmp_name'][$i] != '')
			{
				$abc=date("dmyHis");
				$imgname=$abc.$newname;
				if(move_uploaded_file($tmpfile, $upload_dir.$imgname))
				{
				  $resizeObj_20 = new resize($upload_dir.$imgname); 
				  $resizeObj_20 -> resizeImage(32, 32, 'exact');
				  $resizeObj_20 -> saveImage($upload_dir.$imgname,$upload_dir.$imgname, 100);
				}
			}		
			
			
			$selectquestion="select * from tbl_sectionlink where Section_Id='".$lastId."' and Title='".$final_question."' and Link='".$final_link."' and Status != 2";
			$res_select = $modelObj -> fetchRow($selectquestion);
			if(strtolower(trim($res_select['Title'])) != strtolower(trim($final_question)))
			{
				$insertquestion=mysql_query("insert into tbl_sectionlink (Section_Id,Title,Order_no,Link,page_name,section_name,Status,Image) 
				VALUES ('".$lastId."','".clear_input($final_question)."','".clear_input($final_marks)."','".clear_input($final_link)."','".clear_input($final_title)."','".clear_input($final_htitle)."',1,'".clear_input($imgname)."')");
				
				$mainpageid=strtolower($final_link);
				if($final_tables=="default")
				{
					$createtable="CREATE TABLE tbl_".$mainpageid." (
						id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
						".$mainpageid."_1 VARCHAR( 50 ) NOT NULL ,
						".$mainpageid."_2 VARCHAR( 50 ) NOT NULL ,
						".$mainpageid."_3 VARCHAR( 50 ) NOT NULL ,
						".$mainpageid."_4 VARCHAR( 50 ) NOT NULL ,
						cr_date DATETIME NOT NULL ,
						status INT( 11 ) NOT NULL
						) ENGINE = InnoDB;";
					$result_createtable = $modelObj->runQuery($createtable);
					$final_tables="tbl_".$mainpageid;
				}
				$mytables=$final_tables;
				$qry_desctable="Desc ".$final_tables."";	
				$result_desctable = $modelObj -> fetchRows($qry_desctable);	
				$myarray=array();
				foreach($result_desctable as $k => $values)
				{
					if($values['Field'] != 'id' && $values['Field'] != 'cr_date' && $values['Field'] != 'status')
					{
						$myarray[]=$values;
					}
					if(preg_match("/country/i", $values['Field']))
					{
						$countryy="yes";
						$countryy_name="txt_add".$values['Field'];
					}
					if(preg_match("/state/i", $values['Field']))
					{
						$states="yes";
						$states_name="txt_add".$values['Field'];
					}
					if(preg_match("/city/i", $values['Field']))
					{
						$cityy="yes";
						$cityy_name="txt_add".$values['Field'];
					}
					if(preg_match("/zip/i", $values['Field']))
					{
						$zipp="yes";
						$zipp_name="txt_add".$values['Field'];
					}
				}
				$totalrecord=count($myarray);
				$_POST['txt_pageid']=$final_link;
				include('../ajax_controller/javascriptcommon.php');
				include('../ajax_controller/viewcommon.php');				
				include('../ajax_controller/modelcommon.php');
				include('../ajax_controller/controllercommon.php');
				include('../ajax_controller/ajaxcontrollercommon.php');
			}
		}		
		
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
	$qry = "UPDATE  tbl_section SET status = ".mysql_real_escape_string($_POST['status'])." WHERE Section_Id = ".mysql_real_escape_string($_POST['statusid']);
	$result =  $modelObj->runQuery($qry);
}
?>
<?php
if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){
	$flag = 1;
	
	if($flag == 1)
	{
		$qry = "UPDATE tbl_agent SET 
		first_name = '".mysql_real_escape_string(trim($_POST['txt_firstname']))."', 
		last_name = '".mysql_real_escape_string(trim($_POST['txt_lastname']))."',	 
		company = '".mysql_real_escape_string(trim($_POST['txt_company']))."', 
		registerno = '".mysql_real_escape_string(trim($_POST['txt_registerno']))."', 
		companyaddress = '".mysql_real_escape_string(trim($_POST['txt_compaddress']))."', 
		address = '".mysql_real_escape_string(trim($_POST['txt_address']))."', 
		country = '".mysql_real_escape_string(trim($_POST['txt_country']))."', 
		state = '".mysql_real_escape_string(trim($_POST['txt_state']))."', 
		city = '".mysql_real_escape_string(trim($_POST['txt_city']))."' , 
		zipcode = '".mysql_real_escape_string(trim($_POST['txt_zipcode']))."', 
		phoneno1 = '".mysql_real_escape_string(trim($_POST['txt_phoneno1']))."' , 
		phoneno2 = '".mysql_real_escape_string(trim($_POST['txt_phoneno2']))."'   
		WHERE id = '".mysql_real_escape_string($_POST['hid_userid'])."'";
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
	
	if($_POST['search'] != '0')
	{
		$_SESSION['srchqry'] ="";
	    
		if($_POST['fieldname'] == '0')
		{
			$qry = "SELECT * FROM tbl_section where status!=2 ".$_SESSION['srchqry']." order by Order_no LIMIT $start,$end ";
		}
		else
		{
			$qry = "SELECT * FROM tbl_section where status!=2 ".$_SESSION['srchqry']." ORDER BY ".$_POST['fieldname']." asc LIMIT $start,$end";
		}
		$qry11 = mysql_query("SELECT * FROM tbl_section where status!=2 ".$_SESSION['srchqry']."")or die(mysql_error());
	}
	else
	{
		if($_POST['fieldname'] == '0')
		{
			$qry = "SELECT * FROM tbl_section where status!=2 order by Order_no LIMIT $start,$end ";
		}
		else
		{
			$qry = "SELECT * FROM tbl_section where status!=2 ORDER BY ".$_POST['fieldname']." asc LIMIT $start,$end";
		}	  
		$qry11 = mysql_query("SELECT * FROM tbl_section where status!=2 ")or die(mysql_error());
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
<!-- action box -->
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
	 <td width="15%">
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
	<td width="14%"><?php /*?><input class="button_bg" type="button" value="Add New" name="button" onclick="showadd1('<?php echo $_SESSION['pid'] ?>')"><?php */?>
	<td width="64%">&nbsp;</td>
	<td width="7%" align="left" valign="bottom"><input class="button_bg" type="button" value="Search" name="btn_search" onclick="show_search()"></td>
   </tr>
</table>
</div>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
	<tr>
	  <th class="table-header-check"><a id="toggle-all" ></a> </th>
	  <th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('Name')" class="cursorpointer">Section</a></th>
	  <th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('Order_no')" class="cursorpointer">Order</a></th>
	  <th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('Name')" class="cursorpointer">Sub Section</a></th>
	  <th class="table-header-options line-left"><a>Options</a></th>
	</tr>
<?php
$i = 0;
if($result != ''){
	foreach($result  as $k => $data){
	$i++;
	if($i%2==0){
		$class="light_bg";
	}else{
		$class="white_bg";
	}
	$qry_submenu = "SELECT * FROM tbl_sectionlink WHERE status = 1 and Section_Id ='".$data['Section_Id']."' order by Order_no";
	$submenu = $modelObj->fetchRows($qry_submenu);
?>
	<tr id="<?php echo $data['Section_Id']?>" class="<?=$class?>" height="30">
          <td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['Section_Id'];  ?>"/></td>
          <td class="cursorpointer" onclick="edit('<?php echo $data['Section_Id'] ?>','<?php echo $_GET['pid']?>')"><?php echo $data['Name']; ?></td>
          <td><?php echo $data['Order_no']; ?></td>
		  <td><?php 
		  foreach($submenu as $k => $data){
		  	//echo $data['Title']." => ".$data['Order_no']."<br />";
			?>
			<div style="width:100%">
				<div style="float:left;width:60%;text-align:right"><?=$data['Title']?> --> </div>
				<div style="float:left;width:40%"><?=$data['Order_no']?></div>
			</div>
			<?php
		  }
		   ?></td>
          <td class="options-width" ><table>
              <tr>
                <td><?php
					if($data['status'] == '1')
					{
					?>
				  <div id="d_<?=$data['id']?>"> <a id="s_<?=$data['Section_Id']?>" style="cursor:pointer;" title="Active" class="icon-active info-tooltip" onclick="changeStatus('<?=$data['Section_Id']?>');"></a> </div>
				  <input type="hidden" id="status_<?=$data['Section_Id']?>" name="status_<?=$data['Section_Id']?>" value="Active" />
				  <?php
					}
					else
					{
					?>
				  <div id="d_<?=$data['Section_Id']?>"> <a id="s_<?=$data['Section_Id']?>" style="cursor:pointer;" title="Inactive" class="icon-inactive info-tooltip" onclick="changeStatus('<?=$data['Section_Id']?>');"></a> </div>
				  <input type="hidden" id="status_<?=$data['Section_Id']?>" name="status_<?=$data['Section_Id']?>" value="Inactive" />
				  <?php
					}
					?>
                </td>
                <td><a style="cursor:pointer" title="View" class="icon-view info-tooltip" onclick="view('<?php echo $data['Section_Id'] ?>')"></a></td>
                <?php /*?><td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['Section_Id'] ?>','<?php echo $_SESSION['pid']?>')"></a></td><?php */?>
                <td><a style="cursor:pointer" title="Delete" class="icon-delete info-tooltip" onclick="deleteuser('<?php echo $data['Section_Id'] ?>')" ></a></td>
              </tr>
            </table></td>
        </tr>
	<?php 
		} 
	 }
	 else
	 { 
	 ?>
		 <tr height="30"><td colspan="6" align="center" style="color:#FF0000"><strong><?php echo "No menu found."; ?></strong></td></tr>
	 <?php 
	 }
	 ?>
	</table>

<?php
if($result != ''){
	$paging = $modelObj->ajaxpaging_advancesearch($start,$result_numrec,$curr_page,$noofpages,$noofrows_k,$end);
	echo $paging;
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
		$qry = "UPDATE tbl_section SET status = 2 WHERE Section_Id = '".$_POST['id']."'";
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
	$qry = "SELECT * FROM tbl_section WHERE Section_Id = '".$_POST['id']."'";
	$data = $modelObj->fetchRow($qry);
	
	$qry_submenu="SELECT * FROM tbl_sectionlink WHERE Section_Id='".$_POST['id']."' order by Order_no";
	$result_submenu = $modelObj->fetchRows($qry_submenu);
?>
<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script>
<form name="form_menuadd" id="form_menuadd" method="post" enctype="multipart/form-data" action="#" >
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%">
		<tr class="light_bg">
			<th>Section Name : </th>
			<td width="25%"><input class="input_box" type="text" name="txt_sectionname" id="txt_sectionname" value="<?php echo $data['Name'] ?>" onblur="checkfield(this)"><font class="required"> *</font>
			</td>
			<td id="errortxt_sectionname" width="55%">
				<label class="removerror error_new" id="error-innertxt_sectionname"></label>
            </td>
		</tr>
        <tr class="white_bg">
			<th>Order No. : </th>
			<td><input type="text" class="input_box"  name="txt_sectionorder" id="txt_sectionorder" value="<?php echo $data['Order_no'] ?>" onblur="checkfield(this)"/><font class="required"> *</font></td>
			<td id="errortxt_sectionorder">
				<label class="removerror error_new" id="error-innertxt_sectionorder"></label>
            </td>
		</tr>
		<tr class="light_bg">
			<th>Page ID : </th>
			<td><input type="text" class="input_box"  name="txt_pageid" id="txt_pageid" value="<?php echo $data['Link'] ?>" onblur="checkfield(this)"/><font class="required"> *</font></td>
			<td id="errortxt_pageid">
				<label class="removerror error_new" id="error-innertxt_pageid"></label>
            </td>
		</tr>
		<tr class="white_bg">
			<th>Page Title : </th>
			<td><input type="text" class="input_box"  name="txt_pagename" id="txt_pagename" value="<?php echo $data['page_name'] ?>" onblur="checkfield(this)"/><font class="required"> *</font></td>
			<td id="errortxt_pagename">
				<label class="removerror error_new" id="error-innertxt_pagename"></label>
            </td>
		</tr>
		<tr class="light_bg">
			<th>Header Title : </th>
			<td><input type="text" class="input_box"  name="txt_headername" id="txt_headername" value="<?php echo $data['section_name'] ?>" onblur="checkfield(this)"/><font class="required"> *</font></td>
			<td id="errortxt_headername">
				<label class="removerror error_new" id="error-innertxt_headername"></label>
            </td>
		</tr>
		<tr class="white_bg">
			<th>Select Table : </th>
			<td>
			<select name="combo_tables" id="combo_tables" class="select_box">
				<option value="">Default Table</option>
				<?php
				$qry_tables="SHOW TABLES";
				$result_tables = $modelObj->fetchRows($qry_tables);
				foreach($result_tables as $k => $data)
				{
					?>
					<option value="<?=$data['Tables_in_'.$_SESSION['databasename']]?>"><?=$data['Tables_in_'.$_SESSION['databasename']]?></option>
					<?php
				}
				?>
			</select><font class="required"> *</font>
			</td>
			<td id="errorcombo_tables">
				<label class="removerror error_new" id="error-innercombo_tables"></label>
            </td>
		</tr>
		<tr class="light_bg">
			<th>Logo : </th>
			<td><input type="file" class="input_box"  name="txt_logo" id="txt_logo" value="" /></td>
			<td id="errortxt_logo">
				<label class="removerror error_new" id="error-innertxt_logo"></label>
            </td>
		</tr>
		<tr class="white_bg">
			<th valign="middle"><font style="font-size:16px">Sub Section Detail</font></th>
			<td><font style="font-size:16px"><a href="javascript:void(0)" onclick="addFormField(); return false;">Add More</a></font></td>
			<td>&nbsp;</td>
		</tr>
		</table>
		<?php
		if($_POST['id']==0)
		{
		?>
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%">
        <tr class="light_bg">
			<th>Sub-Section Name : </th>
			<td width="25%"><input name='txt_subsection[]' id='txt_subsection_1' type='text' onblur='checkfield_2(this)' class='input_box' /><font class="required"> *</font></td>
			<td id="errortxt_subsection_1" width="55%">
				<label class="removerror error_new" id="error-innertxt_subsection_1"></label>
            </td>
		</tr>
		<tr class="white_bg">
			<th>Order No. : </th>
			<td><input name='txt_subsectionorder[]' id='txt_subsectionorder_1' type='text' onblur='checkfield_2(this)' class='input_box' /><font class="required"> *</font></td>
			<td id="errortxt_subsectionorder_1">
				<label class="removerror error_new" id="error-innertxt_subsectionorder_1"></label>
            </td>
		</tr>
		<tr class="light_bg">
			<th>Page ID : </th>
			<td><input name='txt_subpageid[]' id='txt_subpageid_1' type='text' onblur='checkfield_2(this)' class='input_box' /><font class="required"> *</font></td>
			<td id="errortxt_subpageid_1">
				<label class="removerror error_new" id="error-innertxt_subpageid_1"></label>
            </td>
		</tr>
		<tr class="white_bg">
			<th>Page Title : </th>
			<td><input name='txt_subpagetitle[]' id='txt_subpagetitle_1' type='text' onblur='checkfield_2(this)' class='input_box' /><font class="required"> *</font></td>
			<td id="errortxt_subpagetitle_1">
				<label class="removerror error_new" id="error-innertxt_subpagetitle_1"></label>
            </td>
		</tr>
		<tr class="light_bg">
			<th>Header Title : </th>
			<td><input name='txt_subheadertitle[]' id='txt_subheadertitle_1' type='text' onblur='checkfield_2(this)' class='input_box' /><font class="required"> *</font></td>
			<td id="errortxt_subheadertitle_1">
				<label class="removerror error_new" id="error-innertxt_subheadertitle_1"></label>
            </td>
		</tr>
		<tr class="white_bg">
			<th>Select Table : </th>
			<td>
			<select name="combo_subtables[]" id="combo_subtables_1" class="select_box">
				<option value="default">Default Table</option>
				<?php
				$qry_tables="SHOW TABLES";
				$result_tables = $modelObj->fetchRows($qry_tables);
				foreach($result_tables as $k => $data)
				{
					?>
					<option value="<?=$data['Tables_in_'.$_SESSION['databasename']]?>"><?=$data['Tables_in_'.$_SESSION['databasename']]?></option>
					<?php
				}
				?>
			</select><font class="required"> *</font>
			</td>
			<td id="errorcombo_subtables_1">
				<label class="removerror error_new" id="error-innercombo_subtables_1"></label>
            </td>
		</tr>
		<tr class="light_bg">
			<th>Logo : </th>
			<td><input type="file" class="input_box"  name="txt_sublogo[]" id="txt_sublogo_1" /></td>
			<td id="errortxt_sublogo_1">
				<label class="removerror error_new" id="error-innertxt_sublogo_1"></label>
            </td>
		</tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%">
	        <input type="hidden" id="id" name="id" value="2"><div id="divTxt"></div>
        </table>
        <?php
		}
		?>
		<?php
		if($_POST['id']!=0)
		{
		?>
			<div id="divTxt">
            <?php
			$ii=0;
			
			$selectcontact=mysql_query("select * from tbl_sectionlink where Section_Id='".$_POST['id']."' order by Order_no");
			while($rowcontact=mysql_fetch_array($selectcontact))
			{
				$ii=$ii+1;
				?>
                <table border="0" cellpadding="0" cellspacing="0" id="row<?=$ii?>" width="100%">
                <?php
				if($ii > 1)
				{
				?>
				<tr height="10">
                <td colspan="3">---------------------------------------------------------------------------------------------------------------------<a style='cursor:pointer' onClick='removeFormField("#row<?=$ii?>"); return false;'><img src='<?=$LOCATION['SITE_ADMIN']?>images/1.png' title='remove contact detail' /></a></td>
                </tr>
				<?php
				}
				?>
                <tr class="light_bg">
					<th>Sub-Section Name : </th>
					<td width="25%"><input name='txt_subsection[]' id='txt_subsection_<?=$ii?>' type='text' onblur='checkfield_2(this)' class='input_box' value="<?=$rowcontact['Title']?>" /><font class="required"> *</font></td>
					<td id="errortxt_subsection_<?=$ii?>" width="55%">
						<label class="removerror error_new" id="error-innertxt_subsection_<?=$ii?>"></label>
					</td>
				</tr>
                <tr class="white_bg">
					<th>Order No. : </th>
					<td><input name='txt_subsectionorder[]' id='txt_subsectionorder_<?=$ii?>' type='text' onblur='checkfield_2(this)' class='input_box' value="<?=$rowcontact['Order_no']?>" /><font class="required"> *</font></td>
					<td id="errortxt_subsectionorder_<?=$ii?>">
						<label class="removerror error_new" id="error-innertxt_subsectionorder_<?=$ii?>"></label>
					</td>
				</tr>
				<tr class="light_bg">
					<th>Page ID : </th>
					<td><input name='txt_subpageid[]' id='txt_subpageid_<?=$ii?>' type='text' onblur='checkfield_2(this)' class='input_box' value="<?=$rowcontact['Link']?>" /><font class="required"> *</font></td>
					<td id="errortxt_subpageid_<?=$ii?>">
						<label class="removerror error_new" id="error-innertxt_subpageid_<?=$ii?>"></label>
					</td>
				</tr>
				<tr class="white_bg">
					<th>Page Title : </th>
					<td><input name='txt_subpagetitle[]' id='txt_subpagetitle_<?=$ii?>' type='text' onblur='checkfield_2(this)' class='input_box' value="<?=$rowcontact['page_name']?>" /><font class="required"> *</font></td>
					<td id="errortxt_subpagetitle_<?=$ii?>">
						<label class="removerror error_new" id="error-innertxt_subpagetitle_<?=$ii?>"></label>
					</td>
				</tr>
				<tr class="light_bg">
					<th>Header Title : </th>
					<td><input name='txt_subheadertitle[]' id='txt_subheadertitle_<?=$ii?>' type='text' onblur='checkfield_2(this)' class='input_box' value="<?=$rowcontact['section_name']?>" /><font class="required"> *</font></td>
					<td id="errortxt_subheadertitle_<?=$ii?>">
						<label class="removerror error_new" id="error-innertxt_subheadertitle_<?=$ii?>"></label>
					</td>
				</tr>
				<tr class="white_bg">
					<th>Select Table : </th>
					<td><select name="combo_subtables[]" id="combo_subtables_<?=$ii?>" class="select_box">
						<option value="default">Default Table</option>
						<?php
						$qry_tables="SHOW TABLES";
						$result_tables = $modelObj->fetchRows($qry_tables);
						foreach($result_tables as $k => $data)
						{
							
							?>
							<option value="<?=$data['Tables_in_'.$_SESSION['databasename']]?>"><?=$data['Tables_in_'.$_SESSION['databasename']]?></option>
							<?php
						}
						?>
					</select><font class="required"> *</font>
					</td>
					<td id="errorcombo_subtables_<?=$ii?>">
						<label class="removerror error_new" id="error-innercombo_subtables_<?=$ii?>"></label>
					</td>
				</tr>
				<tr class="light_bg">
					<th>Logo : </th>
					<td><input type="file" class="input_box"  name="txt_sublogo[]" id="txt_sublogo_<?=$ii?>" /></td>
					<td id="errortxt_sublogo_<?=$ii?>">
						<label class="removerror error_new" id="error-innertxt_sublogo_<?=$ii?>"></label>
					</td>
				</tr>
                </table>
                <?php
			}
			?>
            </div>
            <input type="hidden" id="id" name="id" value="<?=$ii+1;?>">
			<?php
			}
			?> 		
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%">    
        <tr height="20">
        	<td colspan="3">&nbsp;</td>
        </tr>  
		<tr class="white_bg">
			<th>&nbsp;</th>
			<td valign="top" colspan="2">
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
				<input class="button_bg" type="button" value="Add More" name="btn_addmore" onclick="addFormField(); return false;">
			<?php
			}
			?>
			</td>
		</tr>
	</table>
    </form>
<?php 
  }
?>
<?php
if(isset($_POST['addsubsectionform']) && $_POST['addsubsectionform'] != ''){
?>
<table border='0' cellpadding='0' cellspacing='0' id='row<?=$_POST['id']?>' width="100%">
	<tr height='10'>
		<td colspan='3'>---------------------------------------------------------------------------------------------------------------------<a style='cursor:pointer' onClick='removeFormField("#row<?=$_POST['id']?>"); return false;'> <img src='images/1.png' title='remove contact detail' /></a></td>
	</tr>
	<tr class="light_bg">
		<th style="min-width: 210px;padding: 5px 10px 5px 0;text-align: right;width: 130px;">Sub-Section Name : </th>
		<td width="25%" style="padding: 5px 0;"><input name='txt_subsection[]' id='txt_subsection_<?=$_POST['id']?>' type='text' onblur='checkfield_2(this)' class='input_box'/><font class="required"> *</font></td>
		<td style="padding: 5px 0;" id='errortxt_subsection_<?=$_POST['id']?>' width="55%">
			<label class='removerror error_new' id='error-innertxt_subsection_<?=$_POST['id']?>'></label>
		</td>
	</tr>
	<tr class="white_bg">
		<th style="min-width: 210px;padding: 5px 10px 5px 0;text-align: right;width: 130px;">Order No. : </th>
		<td style="padding: 5px 0;"><input name='txt_subsectionorder[]' id='txt_subsectionorder_<?=$_POST['id']?>' type='text' onblur='checkfield_2(this)' class='input_box'/><font class="required"> *</font></td>
		<td style="padding: 5px 0;" id='errortxt_subsectionorder_<?=$_POST['id']?>'>
			<label class='removerror error_new' id='error-innertxt_subsectionorder_<?=$_POST['id']?>'></label>
		</td>
	</tr>
	<tr class="light_bg">
		<th style="min-width: 210px;padding: 5px 10px 5px 0;text-align: right;width: 130px;">Page ID : </th>
		<td style="padding: 5px 0;"><input name='txt_subpageid[]' id='txt_subpageid_<?=$_POST['id']?>' type='text' onblur='checkfield_2(this)' class='input_box' /><font class="required"> *</font></td>
		<td style="padding: 5px 0;" id='errortxt_subpageid_<?=$_POST['id']?>'>
			<label class='removerror error_new' id='error-innertxt_subpageid_<?=$_POST['id']?>'></label>
		</td>
	</tr>
	<tr class="white_bg">
		<th style="min-width: 210px;padding: 5px 10px 5px 0;text-align: right;width: 130px;">Page Title : </th>
		<td style="padding: 5px 0;"><input name='txt_subpagetitle[]' id='txt_subpagetitle_<?=$_POST['id']?>' type='text' onblur='checkfield_2(this)' class='input_box' /><font class="required"> *</font></td>
		<td style="padding: 5px 0;" id='errortxt_subpagetitle_<?=$_POST['id']?>'>
			<label class='removerror error_new' id='error-innertxt_subpagetitle_<?=$_POST['id']?>'></label>
		</td>
	</tr>
	<tr class="light_bg">
		<th style="min-width: 210px;padding: 5px 10px 5px 0;text-align: right;width: 130px;">Header Title : </th>
		<td style="padding: 5px 0;"><input name='txt_subheadertitle[]' id='txt_subheadertitle_<?=$_POST['id']?>' type='text' onblur='checkfield_2(this)' class='input_box' /><font class="required"> *</font></td>
		<td style="padding: 5px 0;" id='errortxt_subheadertitle_<?=$_POST['id']?>'>
			<label class='removerror error_new' id='error-innertxt_subheadertitle_<?=$_POST['id']?>'></label>
		</td>
	</tr>
	<tr class="white_bg">
		<th style="min-width: 210px;padding: 5px 10px 5px 0;text-align: right;width: 130px;">Select Table : </th>
		<td style="padding: 5px 0;">
		<select name="combo_subtables[]" id="combo_subtables_<?=$_POST['id']?>" class="select_box">
			<option value="default">Default Table</option>
			<?php
			$qry_tables="SHOW TABLES";
			$result_tables = $modelObj->fetchRows($qry_tables);
			foreach($result_tables as $k => $data)
			{
				
				?>
				<option value="<?=$data['Tables_in_'.$_SESSION['databasename']]?>"><?=$data['Tables_in_'.$_SESSION['databasename']]?></option>
				<?php
			}
			?>
		</select><font class="required"> *</font>
		</td>
		<td style="padding: 5px 0;" id='errorcombo_subtables_<?=$_POST['id']?>'>
			<label class='removerror error_new' id='error-innercombo_subtables_<?=$_POST['id']?>'></label>
		</td>
	</tr>
	<tr class="light_bg">
		<th style="min-width: 210px;padding: 5px 10px 5px 0;text-align: right;width: 130px;">Logo : </th>
		<td style="padding: 5px 0;"><input type='file' class='input_box'  name='txt_sublogo[]' id='txt_sublogo_<?=$_POST['id']?>' /></td>
		<td style="padding: 5px 0;" id='errortxt_sublogo_<?=$_POST['id']?>'>
			<label class='removerror error_new' id='error-innertxt_sublogo_<?=$_POST['id']?>'></label>
		</td>
	</tr>
</table>
<?php
}
?>