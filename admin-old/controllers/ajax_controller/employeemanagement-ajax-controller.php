<?php 
    @session_start();
	include('../../models/db.php');
	include('../../models/common-model.php');
	include('../common-controller.php');
	$database = new Connection();
	include('../../models/ajax-model.php');
	$modelObj = new AjaxModel();
?>
<?php 
if(isset($_POST['showsection']) && $_POST['showsection'] != ''){
      $qrysection = "select * from tbl_section where Status='1' order by Order_no";
	   $resultcntmainsection = $modelObj -> numRows($qrysection);					
	  $resultsection = $modelObj -> fetchRows($qrysection);
?>
	<table border="0" cellpadding="0" cellspacing="0">
	    <tr height="30">
	     <td valign="top"><strong>Roll Management:</strong></td>
	   </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" style="border:#999999 .5px solid;">
    <tr>
     <td colspan="3">
	<div style="overflow:auto;height:300px" > 
	    <table width="800" border="1">
		<tr><td colspan="3" height="20"></td></tr>
		     <tr> 
                <td width="200" style="border-bottom:#999999 1px solid;"><strong>&nbsp;Main Section </strong></td>
                <td width="600" style="border-bottom:#999999 1px solid;"><strong>Sub Section</strong></td>
			   <input type="hidden" name="hid_cntmainsection" id="hid_cntmainsection" value="<?php echo $resultcntmainsection ?>" />
			 </tr>
			 <?php
			 $j = 0;
			  if( $resultsection != ''){
			     foreach($resultsection as $k => $val){
			  ?>
			   <tr>
			     <td  valign="top">
				    <table>
					    <tr>
						  <td valign="top"> 
						      <input type="checkbox" name="chk_mainsection<?php echo $j ?>" id="chk_mainsection<?php echo $j ?>" onChange="checkall(<?php echo $j; ?>)" value="<?php echo $val['Section_Id'] ?>" />
						  </td>
						  	 <td valign="top"><?php echo $val['Name'] ?></td>
						</tr>
					</table>
				 </td>
			     <td valign="top">
				    <table cellpadding="5" cellspacing="5" border="1">
					   <?php
					     $qrysubsection = "SELECT * FROM tbl_sectionlink   WHERE status = '1' and Section_Id  ='".$val['Section_Id']."' order by Order_no";
						 $resultcntsubsection = $modelObj -> numRows($qrysubsection);						  
	                     $resultsubsection = $modelObj -> fetchRows($qrysubsection);
					   ?>
					   <input type="hidden" name="hid_cntsubsection<?php echo $j ?>" id="hid_cntsubsection<?php echo $j ?>" value="<?php echo $resultcntsubsection ?>" />
					   <?php
					     $i = 0;
					     if($resultsubsection  != ''){
						    foreach($resultsubsection  as $k => $valsub){
							  if($i % 6 ==0){
							    echo "</tr><tr>";
							  }
					   ?>
					       <td width="20" valign="top">
						   
						     <input type="checkbox" name="chk_subsection<?php echo $j.$i ?>" id="chk_subsection<?php echo $j.$i ?>" value="<?php echo $valsub['Subsection_Id'] ?>" onChange="check_main(<?php echo $j; ?>)" />
						   </td>
					      <td  valign="top"><?php echo $valsub['Title'] ?></td>&nbsp;&nbsp;
					   <?php 
					     $i++;
					     } 
					   }else{
					   ?>
					    <tr><td>No Subsection Found</td></tr>
					   <?php } ?>
					</table>
				 </td>
			   </tr>
			  <?php 
			  $j++;
			  }
			  }else{
			  ?>
			    <tr><td>No Section Found</td></tr>
			  <?php } ?>
		</table>
		</div>
	</td>
</tr>
</table>
<?php } ?>

<?php
if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){
	$qry = "SELECT email,username FROM admin WHERE (username = '".mysql_real_escape_string(trim($_POST['txt_username']))."' or email = '".mysql_real_escape_string(trim($_POST['txt_emailid']))."')
	            and adminid != '".mysql_real_escape_string($_POST['hid_updateid'])."' ans Status != 2";
   $result = $modelObj -> fetchRow($qry);
   if(strtolower(trim($result['username'])) ==  strtolower(trim($_POST['txt_username']))){
	 	$flag = 0;
   }else if(strtolower(trim($result['email'])) ==  strtolower(trim($_POST['txt_emailid']))){
	 	$flag = 3;
   }else{
     $flag = 1;
   }
   if($flag == 1){
   
    $qry = "UPDATE admin SET firstname = '".clear_input($_POST['txt_firstname'])."',
		   lastname =  '".clear_input($_POST['txt_lastname'])."',
		   username = '".clear_input($_POST['txt_username'])."',
		   email = '".clear_input($_POST['txt_emailid'])."',
		   user_type =  '".clear_input($_POST['sel_usertype'])."',
		   Modify_date  = '".date('Y-m-d')."',
		   Modify_Id = '".clear_input($_SESSION['ADMIN_ID'])."'
		   WHERE adminid = '".mysql_real_escape_string(trim($_POST['hid_updateid']))."'";
	     $result = $modelObj->runQuery($qry);
	     if($result){
		 $id = $_POST['hid_updateid'];
		  $qrydelete = "DELETE  FROM rollmanagement WHERE Emp_Id = '". $id ."'";
		    $resultdelete = $modelObj->runQuery($qrydelete);
		    if($_POST['sel_usertype'] == 1){
			     for($i = 0;$i<$_POST['hid_cntmainsection']; $i++){
				     if(isset($_POST['chk_mainsection'.$i])){
					    if(count($_POST['hid_cntsubsection'.$i]) != 0){
							 for($j=0;$j<$_POST['hid_cntsubsection'.$i];$j++){
									 if(isset($_POST['chk_subsection'.$i.$j])){
										 $subsection = $_POST['chk_subsection'.$i.$j].",".$subsection;
									 }
							 }
							  $qryrights = "INSERT INTO rollmanagement(Emp_Id,mainsection,subsection)
											 VALUES('".mysql_real_escape_string($id)."',
													 '".mysql_real_escape_string($_POST['chk_mainsection'.$i])."',
													 '".mysql_real_escape_string($subsection)."')";  
							 $resultrights = $modelObj->runQuery($qryrights);
							  $subsection = '';
							  
						}else{
						    $qryrights = "INSERT INTO rollmanagement(Emp_Id,mainsection)
										 VALUES('".mysql_real_escape_string($id)."',
													 '".mysql_real_escape_string($_POST['chk_mainsection'.$i])."')";  
							 $resultrights = $modelObj->runQuery($qryrights);
							  $subsection = '';
						}	  
					 }
				 }
			}
		   echo "1";
		 }else{
	      echo "2";	 
		 }
   }else{
     echo $flag;
   }
}
?>

<?php
if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){
	$qry = "SELECT email,username FROM admin WHERE (username = '".mysql_real_escape_string(trim($_POST['txt_username']))."' or email = '".mysql_real_escape_string(trim($_POST['txt_emailid']))."') and status != 2";
   $result = $modelObj -> fetchRow($qry);
   if(strtolower(trim($result['username'])) ==  strtolower(trim($_POST['txt_username']))){
	 	$flag = 0;
   }else if(strtolower(trim($result['email'])) ==  strtolower(trim($_POST['txt_emailid']))){
	 	$flag = 3;
   }else{
     $flag = 1;
   }
   if($flag == 1){
   
    $qry = "INSERT INTO admin (firstname,lastname,username,password,email,user_type,Created_Id,Created_date,status) 
		    VALUES ('".clear_input($_POST['txt_firstname'])."',
				 '".clear_input($_POST['txt_lastname'])."',
				 '".clear_input($_POST['txt_username'])."',
				 '".mysql_real_escape_string(trim(md5($_POST['txt_password'])))."',
				  '".clear_input($_POST['txt_emailid'])."',
				  '".clear_input($_POST['sel_usertype'])."',
				 '".mysql_real_escape_string(trim($_SESSION['ADMIN_ID']))."',
				  '".date('Y-m-d')."',1)";
	     $result = $modelObj->runQuery($qry);
	     if($result){
		   $id = mysql_insert_id();
		    if($_POST['sel_usertype'] == 1){
			     for($i = 0;$i<$_POST['hid_cntmainsection']; $i++){
				     if(isset($_POST['chk_mainsection'.$i])){
					    if(count($_POST['hid_cntsubsection'.$i]) != 0){
							 for($j=0;$j<$_POST['hid_cntsubsection'.$i];$j++){
									 if(isset($_POST['chk_subsection'.$i.$j])){
										 $subsection = $_POST['chk_subsection'.$i.$j].",".$subsection;
									 }
							 }
							  $qryrights = "INSERT INTO rollmanagement(Emp_Id,mainsection,subsection)
											 VALUES('".mysql_real_escape_string($id)."',
											 '".mysql_real_escape_string($_POST['chk_mainsection'.$i])."',
											 '".mysql_real_escape_string($subsection)."')";  
							 $resultrights = $modelObj->runQuery($qryrights);
							  $subsection = '';
							  
						}else{
						    $qryrights = "INSERT INTO rollmanagement(Emp_Id,mainsection)
										 VALUES('".mysql_real_escape_string($id)."',
													 '".mysql_real_escape_string($_POST['chk_mainsection'.$i])."')";  
							 $resultrights = $modelObj->runQuery($qryrights);
							  $subsection = '';
						}	  
					 }
				 }
			}
		   echo "1";
		 }else{
	      echo "2";	 
		 }
   }else{
     echo $flag;
   }
}
?>
<?php
if(isset($_POST['view']) && $_POST['view'] != ''){
    $id = $_POST['id'];
	$qry = "SELECT * FROM admin WHERE adminid = '".mysql_real_escape_string($id)."'";
	$result = $modelObj->fetchRow($qry);
	
	  if($result['user_type'] == '1'){
	   $qrysection = "select * from rollmanagement WHERE Emp_Id = '".mysql_real_escape_string($id)."'";
	    $resultsection = $modelObj -> fetchRows($qrysection);
		foreach($resultsection as $k => $val){
		    $mid = $val['mainsection'].",".$mid;
		}
		$finalid = substr($mid,0,(strlen($mid)-1));
		$qrymainsec = "select * from tbl_section  where Status='1'  and Section_Id IN  (".$finalid.") order by Order_no";
		$resultmainsec = $modelObj -> fetchRows($qrymainsec);
	  }
	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="light_bg">
        <td width="120" align="right" class="popup_listing_border"><strong>Name:</strong></td>
        <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td width="469" align="left" class="popup_listing_border"><?php echo $result['firstname']." ".$result['lastname'] ?></td>
      </tr>
	   <tr class="white_bg">
        <td align="right" class="popup_listing_border"><strong>User Name:</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td width="469" align="left" class="popup_listing_border"><?php echo $result['username'] ?></td>
      </tr>
      <tr class="light_bg">
        <td align="right" class="popup_listing_border"><strong>Email Address:</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border"><?php echo $result['email'] ?></td>
      </tr>      
      <tr class="white_bg">
        <td align="right" class="popup_listing_border"><strong>User Type:</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border">
		<?php if($result['user_type'] == '0') echo 'Super Admin';else echo 'Employee' ?>
		</td>
      </tr>
	   <?php
	   if($result['user_type'] == '1'){
	  ?>
	  <tr class="light_bg">
        <td align="left" class="popup_listing_border"><strong><u>Roll Management</u></strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border"></td>
      </tr>
	  <tr class="white_bg">
          <td colspan="3" width="600">
		      <table width="600" >
			   <tr>
			     <td width="150"><strong>Main Section</strong></td>
				 <td width="450"><strong>Sub Section</strong></td>
			   </tr>
			   <tr>
			     <td width="150" height="20"></td>
				 <td width="450"></td>
			   </tr>
			  <?php 
			  if($resultmainsec != ''){
			     foreach($resultmainsec as $k => $val){
				   $qrysubsection = "select * from rollmanagement WHERE Emp_Id = '".mysql_real_escape_string($id)."'
		                        and mainsection = '".mysql_real_escape_string($val['Section_Id'])."'";
				$resultsubsection = $modelObj -> fetchRow($qrysubsection);
				  $subid = substr($resultsubsection['subsection'],0,(strlen($resultsubsection['subsection'])-1));
				$qrysub = "SELECT * FROM tbl_sectionlink   WHERE status = '1' and Subsection_Id  IN (".$subid.") order by Order_no";
				$resultsubsec = $modelObj -> fetchRows($qrysub);
			   ?>
			       <tr>
				      <td width="150" height="30" valign="top"><?php echo $val['Name'] ?></td>
					  <td valign="top">
					      <table >
						     <?php
							   $i = 0;
							   if($resultsubsec != '')
							   {
							     foreach($resultsubsec as $m => $sval){
								  if($i%4 == 0){
								    echo "</tr><tr>";
								  }
							  ?>
							    <td width="150" height="30" valign="top">
								<?php
								if($sval['Title']=='')
								{
									echo "-";
								}
								else
								{
								 	echo $sval['Title'];
								}
								 ?></td>
							  <?php
							  $i++;
							  }
							   }
							   else
							   {
							   	echo "<tr>";
									echo "<td width='150' height='30' valign='top'>-</td>";
								echo "</tr>";
							   }
							    ?>
						  </table>
					  </td>
				   </tr>
				  <?php } 
				   }
				   ?> 
			  </table>
		  
		  </td>
      </tr>
	  <?php } ?> 
       <tr class="light_bg">
        <td align="right" class="popup_listing_border"><strong>Created Date:</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border"><?php echo date('Y-m-d',strtotime($result['Created_date'])) ?></td>
      </tr> 
      <tr class="white_bg">
        <td align="right" class="popup_listing_border"><strong>Modify Date:</strong></td>
        <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
        <td align="left" class="popup_listing_border"><?php echo date('Y-m-d',strtotime($result['Modify_date'])) ?></td>
      </tr>	  
    </table>
<?php } ?>
<?php
if(isset($_POST['statusactive']) && $_POST['statusactive'] != ''){
   $id = explode("," ,$_POST['active']);
	 foreach($id as $k => $val){
	    $qry = "UPDATE  admin  SET status = 1 WHERE 
          adminid = ".mysql_real_escape_string($val);
        $result =  $modelObj->runQuery($qry);
	 }
	
}
?>
<?php
if(isset($_POST['statusinactive']) && $_POST['statusinactive'] != ''){
   $id = explode("," ,$_POST['inactive']);
	 foreach($id as $k => $val){
	    $qry = "UPDATE  admin  SET status = 0 WHERE 
          adminid = ".mysql_real_escape_string($val);
        $result =  $modelObj->runQuery($qry);
	 }
}
?>
<?php
if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
   $id = explode("," ,$_POST['delete']);
	 foreach($id as $k => $val){
	    $qry = "UPDATE  admin  SET status = 2 WHERE 
          adminid = ".mysql_real_escape_string($val);
        $result =  $modelObj->runQuery($qry);
	 }
}
?>
<?php
if(isset($_POST['statusid']) && $_POST['statusid'] != ''){
   $qry = "UPDATE  admin  SET status = ".mysql_real_escape_string($_POST['status'])." WHERE 
          adminid = ".mysql_real_escape_string($_POST['statusid']);
   $result =  $modelObj->runQuery($qry);
}
?>
<?php
if(isset($_POST['viewdiv']) && $_POST['viewdiv'] != ''){
?>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script>
<?php
	$start = $_POST['prevnext'];
	$end = $_POST['row'];
	
  if($_POST['search'] != '0'){
		     if(trim($_POST['txt_srchfname']) != ''){
						$searchqry .=  "and firstname LIKE '%".trim($_POST['txt_srchfname'])."%'";
						$_SESSION['srchqry'] =  $searchqry; 
			 }
			 if(trim($_POST['txt_srchlname']) != ''){
						 $searchqry .="and  lastname LIKE '%".trim($_POST['txt_srchlname'])."%'";
						$_SESSION['srchqry'] =  $searchqry; 
			}
			if(trim($_POST['txt_srchemail']) != ''){
						 $searchqry .="and email LIKE '%".trim($_POST['txt_srchemail'])."%'";
						$_SESSION['srchqry'] =  $searchqry; 
			} 
			 if(trim($_POST['sel_srchusertypr']) != ''){
						 $searchqry .="and  user_type ='".trim($_POST['sel_srchusertypr'])."'";
						$_SESSION['srchqry'] =  $searchqry; 
			} 
			 if(trim($_POST['sel_srchstatus']) != ''){
						 $searchqry .="and  Status ='".trim($_POST['sel_srchstatus'])."'";
						$_SESSION['srchqry'] =  $searchqry; 
			} 
			
		      $_SESSION['srchqry'] =  $_SESSION['srchqry']; 
	  if($_POST['fieldname'] == '0'){
	     $qry = "SELECT * FROM admin  WHERE status != 2 
		   ".$_SESSION['srchqry']." order by Created_date  desc LIMIT $start,$end";
	  }else{
	     $qry = "SELECT * FROM admin  WHERE status != 2 
		   ".$_SESSION['srchqry']." ORDER BY ".$_POST['fieldname']." asc LIMIT $start,$end";
				 
	   }
		$qry11 = mysql_query("SELECT * FROM admin
		    WHERE status != 2 ".$_SESSION['srchqry']."")or die(mysql_error());
	}else{
		 if($_POST['fieldname'] == '0'){
	  		$qry = "SELECT * FROM admin  WHERE status != 2 
		               ".$_SESSION['srchqry']." order by Created_date  desc LIMIT $start,$end";
		 }else{
		   $qry = "SELECT * FROM admin  WHERE status != 2 
		               ".$_SESSION['srchqry']." ORDER BY ".$_POST['fieldname']." asc LIMIT $start,$end";
		 }
	  
		$qry11 = mysql_query("SELECT * FROM admin WHERE status != 2 ")or die(mysql_error());
	}
   $result = $modelObj->fetchRows($qry);
   $totalrecords = mysql_num_rows($qry11);
   $noofrows_k = $end;
   $noofpages = ceil($totalrecords/$noofrows_k);
   if($_POST['first'] != 0){
        $curr_page =   ceil($start/$noofrows_k);
   }else if($_POST['last'] != 0){
      $curr_page = 0;
   }else{
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
		$('#form_employeemgt input[type=checkbox]').checkBox('toggle');
		return false;
		});
	});
</script> 
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
	<form id="form_employeemgt" action="" name="form_employeemgt" method="post" enctype="multipart/form-data" >
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
	<tr>
		<th class="table-header-check"><a id="toggle-all" ></a> </th>
		<th class="table-header-repeat line-left minwidth-1">
		<a onclick="sortingbyfield('firstname,lastname')" class="cursorpointer">Name</a>	</th>
		<th class="table-header-repeat line-left minwidth-1">
		<a onclick="sortingbyfield('email')" class="cursorpointer">Email Address</a></th>
		<th class="table-header-repeat line-left minwidth-1">
		<a onclick="sortingbyfield('user_type')" class="cursorpointer">User Type</a></th>
		<th class="table-header-options line-left"><a href="">Options</a></th>
	</tr>
   <?php
   $i = 0;
	if($result != ''){
		foreach($result  as $k => $data){
			$i++;
  ?>
	<tr id="<?php echo $data['adminid']?>" class="<?php if($i%2==0){ echo "light_bg"; }else{ echo "white_bg"; } ?>" height="30">
		<td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['adminid'];  ?>"/></td>
		<td class="cursorpointer" onclick="edit('<?php echo $data['adminid'] ?>','<?php echo $_SESSION['pid']?>')"><?php echo $data['firstname']." ".$data['lastname'] ?></td>
		<td><?php echo $data['email'] ?></td>
		<td><?php 
			if($data['user_type'] == 0){
				  echo "Super Admin";
			}else if($data['user_type'] == 1){
			   echo "Employee";
			}
		  ?>
		</td>
		<td class="options-width" >
		<table>
			<tr>
				<td>
					<?php
					if($data['status'] == '1')
					{
					?>
					<div id="d_<?=$data['adminid']?>">
					<a id="s_<?=$data['adminid']?>" style="cursor:pointer;" title="Active" class="icon-active info-tooltip" onclick="changeStatus('<?=$data['adminid']?>');"></a>
					</div>
					<input type="hidden" id="status_<?=$data['adminid']?>" name="status_<?=$data['adminid']?>" value="Active" />						
					<?php
					}
					else
					{
					?>
					<div id="d_<?=$data['adminid']?>">
					<a id="s_<?=$data['adminid']?>" style="cursor:pointer;" title="Inactive" class="icon-inactive info-tooltip" onclick="changeStatus('<?=$data['adminid']?>');"></a>
					</div>
					<input type="hidden" id="status_<?=$data['adminid']?>" name="status_<?=$data['adminid']?>" value="Inactive" />						
					<?php
					}
					?>
				</td>
				<td><a style="cursor:pointer" title="View" class="icon-view info-tooltip" onclick="view('<?php echo $data['adminid'] ?>')"></a></td>
				<td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['adminid'] ?>','<?php echo $_SESSION['pid']?>')"></a></td>
				<td><a style="cursor:pointer" title="Delete" class="icon-delete info-tooltip" onclick="deleteuser('<?php echo $data['adminid'] ?>')" ></a></td>
			</tr>
		</table>
	</td>
	</tr>
	<?php } 
	 }else{ ?>
	 <tr height="30"><td colspan="5" align="center" style="color:#FF0000"><strong><?php echo "No employee found."; ?></strong></td></tr>
	 <?php } ?>
	</table>
<?php
	if($result != ''){
		echo $modelObj->ajaxpaging_advancesearch($start,$result_numrec,$curr_page,$noofpages,$noofrows_k,$end);
		
	  ?>
	<?php }else{ ?>
		<input type="hidden" name="sel_noofrow" id="sel_noofrow" value="20" />
	<?php } ?>
		<input type="hidden" name="hid_fieldname" id="hid_fieldname" value="<?=$_POST['fieldname']?>"  />
		<input type="hidden" name="hidsearch" id="hidsearch" 
		value="<?php if($_POST['search'] != '0') echo '1'; else echo '0' ?>" />
		<input type="hidden" name="viewdiv" id="viewdiv" value="1" />
	</form>
	<?php 
	} ?>
<?php
  if(isset($_POST['edit']) && $_POST['edit'] != ''){
	$qry = "SELECT * FROM admin WHERE adminid = '".$_POST['id']."'";
	$data = $modelObj->fetchRow($qry);
	  $qrysection = "select * from tbl_section  where Status='1' order by Order_no";
	   $resultcntmainsection = $modelObj -> numRows($qrysection);					
	  $resultsection = $modelObj -> fetchRows($qrysection);
	  if($data['user_type'] == '1'){
	    $qrysection1 = "select * from rollmanagement WHERE Emp_Id = '".mysql_real_escape_string($_POST['id'])."'";
	    $resultsection1 = $modelObj -> fetchRows($qrysection1);
		foreach($resultsection1 as $k => $secid){
		    $id = $secid['mainsection'].",".$id;
		}
		$finalid = substr($id,0,(strlen($id)-1));
		$expl = explode(",",$finalid);
	  }
?>
<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script>
 <form name="form_employeemgt" id="form_employeemgt" method="post" enctype="multipart/form-data" action="#" >
     <table border="0" cellpadding="0" cellspacing="0" id="id-form" width="100%">
		<tr class="light_bg">
			<th>User Type :</th>
			<td width="25%">
			 <select name="sel_usertype" id="sel_usertype" onBlur="checkdrpdwnvalnull(this)" onChange="showsection(this.value)" class="select_box">
			 <option value="">Select user type</option>
			 <option value="0" <?php if($data['user_type'] == '0') echo "selected='selected'"; ?>>Super Admin</option>
			 <option value="1" <?php if($data['user_type'] == '1') echo "selected='selected'"; ?>>Employee</option>
			 </select><font class="required"> *</font>
			</td>
			<td id="errorsel_usertype" width="55%">
			<label class="removerror error_new" id="error-innersel_usertype"></label>
            </td>
		</tr>
		<tr class="white_bg">
			<th>First Name :</th>
			<td width="25%"><input type="text" class="input_box"  name="txt_firstname" id="txt_firstname" 
            value="<?php echo stripslashes($data['firstname']) ?>" onblur="checkfield(this)" /><font class="required"> *</font></td>
			<td id="errortxt_firstname" width="55%">
			<label class="removerror error_new" id="error-innertxt_firstname"></label>
            </td>
		</tr>
		<tr class="light_bg">
			<th>Last Name :</th>
			<td width="25%"><input type="text" class="input_box"  name="txt_lastname" id="txt_lastname" 
            value="<?php echo stripslashes($data['lastname']) ?>" onblur="checkfield(this)" /><font class="required"> *</font></td>
			<td id="errortxt_lastname" width="55%">
			<label class="removerror error_new" id="error-innertxt_lastname"></label>
            </td>
		</tr>
        <tr class="white_bg">
			<th>User Name :</th>
			<td width="25%"><input type="text" class="input_box"  name="txt_username" id="txt_username" 
            value="<?php echo stripslashes($data['username']) ?>" onblur="checkalphanumericfield(this)" /><font class="required"> *</font></td>
			<td id="errortxt_username" width="55%">
			<label class="removerror error_new" id="error-innertxt_username"></label>
            </td>
		</tr>
		<?php 
		 if($_POST['id'] ==0){
		?>
		 <tr class="light_bg">
			<th>Password :</th>
			<td width="25%"><input type="password" class="input_box"  name="txt_password" id="txt_password" 
            value="<?php echo $data['password'] ?>" onblur="checkalphanumericfield(this)" /><font class="required"> *</font></td>
			<td id="errortxt_password" width="55%">
			<label class="removerror error_new" id="error-innertxt_password"></label>
            </td>
		</tr>
		 
		<tr class="white_bg">
			<th>Confirm Password :</th>
			<td width="25%"><input type="password" class="input_box"  name="txt_cpassword" id="txt_cpassword" 
            value="<?php echo $data['password'] ?>" onblur="checkfield(this)" /><font class="required"> *</font></td>
			<td id="errortxt_cpassword" width="55%">
			<label class="removerror error_new" id="error-innertxt_cpassword"></label>
            </td>
		</tr>
		<?php } ?>
       <tr class="light_bg">
			<th>Email Address :</th>
			<td width="25%"><input type="text" class="input_box"  name="txt_emailid" id="txt_emailid" 
            value="<?php echo stripslashes($data['email']) ?>" onblur="checkmail(this)" /><font class="required"> *</font></td>
			<td id="errortxt_emailid" width="55%">
			<label class="removerror error_new" id="error-innertxt_emailid"></label>
            </td>
	   </tr>
    </table>
    <table>
    <tr>
    <td colspan="3" id="rollmanagement1" style="display:<?php if($data['user_type']  == '1' && $_POST['id'] != 0) echo 'block'; else echo 'none' ?>;">
	<table border="0" cellpadding="0" cellspacing="0">
	    <tr height="30">
	     <td valign="top"><strong>Roll Management:</strong></td>
	   </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" style="border:#999999 .5px solid;">
	   <tr height="30"> 
            <td width="200" style="border-bottom:#999999 1px solid;"><strong>&nbsp;Main Section </strong></td>
            <td width="600" style="border-bottom:#999999 1px solid;"><strong>Sub Section</strong></td>
            <input type="hidden" name="hid_cntmainsection" id="hid_cntmainsection" value="<?php echo $resultcntmainsection ?>" />
        </tr>
			 <?php
			 $j = 0;
			
			  if( $resultsection != ''){
			     foreach($resultsection as $k => $val){
			  ?>
			   <tr>
			     <td valign="">
				    <table>
					    <tr>
						  <td valign="bottom" style="padding-top:10px;"> 
						      &nbsp;<input  type="checkbox" name="chk_mainsection<?php echo $j ?>" id="chk_mainsection<?php echo $j ?>" onChange="checkall(<?php echo $j; ?>)" value="<?php echo $val['Section_Id'] ?>" 
							  <?php
							   for($k=0;$k<count($expl);$k++){
							     if($expl[$k] == $val['Section_Id']){
								       echo "checked='checked'";
								 }
							  } ?>   />&nbsp;&nbsp;
						  </td>
						  	 <td valign="bottom" style="padding-top:10px;"><?php echo $val['Name'] ?></td>
						</tr>
					</table>
				 </td>
			     <td valign="">
				    <table cellpadding="0" cellspacing="0" border="0">
					<tr>
					   <?php
					     $qrysubsection = "SELECT * FROM tbl_sectionlink WHERE status = '1' and Section_Id  ='".$val['Section_Id']."' order by Order_no";
						 $resultcntsubsection = $modelObj -> numRows($qrysubsection);						  
	                     $resultsubsection = $modelObj -> fetchRows($qrysubsection);
						 
						 $qrysubsection1 = "select * from rollmanagement WHERE Emp_Id = '".mysql_real_escape_string($_POST['id'])."'
		                        and mainsection = '".mysql_real_escape_string($val['Section_Id'])."'";
	                     $resultsubsection1 = $modelObj -> fetchRow($qrysubsection1);
		                 $subid = substr($resultsubsection1['subsection'],0,(strlen($resultsubsection1['subsection'])-1));
						 $explsubid = explode(",",$subid);
					   ?>
					   <input type="hidden" name="hid_cntsubsection<?php echo $j ?>" id="hid_cntsubsection<?php echo $j ?>" value="<?php echo $resultcntsubsection ?>" />
					   <?php
					     $i = 0;
					     if($resultsubsection  != ''){
						    foreach($resultsubsection  as $k => $valsub){
							  if($i % 4 ==0){
							    echo "</tr><tr>";
							  }
					   ?>
					       <td width="20" valign="">
                                 <input type="checkbox" name="chk_subsection<?php echo $j.$i ?>" id="chk_subsection<?php echo $j.$i ?>" onChange="check_main(<?php echo $j; ?>)" value="<?php echo $valsub['Subsection_Id'] ?>" <?php
							   for($k=0;$k<count($explsubid);$k++){
							     if($explsubid[$k] == $valsub['Subsection_Id']){
								       echo "checked='checked'";
								 }
							  } ?> />
						   </td>
					      <td  valign=""><?php echo $valsub['Title'] ?>&nbsp;&nbsp;</td>&nbsp;&nbsp;						  
					   <?php 
					     $i++;
					     } 
						 ?>
						 </tr>
						 <?php
					   }else{
					   ?>
					    <tr><td colspan="2" style="padding-top:10px;">No Subsection Found</td></tr>
					   <?php } ?>
					</table>
				 </td>
			   </tr>
			  <?php 
			  $j++;
			  }
			  }else{
			  ?>
			    <tr><td>No Section Found</td></tr>
			  <?php } ?>
	   </table>
	</td>
    </tr>
    <tr height="10"><td colspan="3"></td></tr>
    </table>
  <!-- </td>
    </tr>-->
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">    
	<tr>
        <th>&nbsp;</th>
		<td valign="top">
        <?php 
		 if($_POST['id'] !=0){
		?>
        <input type="hidden" name="hid_updateid" id="hid_updateid" value="<?php echo $data['adminid'] ?>" />
        <input type="hidden" name="hid_update" id="hid_update" value="update" />
		<input class="button_bg" type="submit" value="Submit" name="btn_update" onclick="return update()">
		<input class="button_bg" type="button" value="Cancel" name="btn_cancel" onclick="newdata()">
       <?php } else{?>
       <input type="hidden" name="hid_add" id="hid_add" value="add" />
	   <input class="button_bg" type="submit" value="Submit" name="btn_save" onclick="return add()">
		<input class="button_bg" type="button" value="Cancel" name="btn_cancel" onclick="newdata()">
       <?php } ?>
		</td>
		<td></td>
	</tr>
	</table>
    </form>
<?php 
  }
?>
<?php
 if(isset($_POST['delete']) && $_POST['delete'] != ''){
      $qry = "UPDATE admin SET status = 2 WHERE adminid = '".$_POST['id']."'";
	  $result = $modelObj->runQuery($qry);
	  if($result){
	    echo $successmsg = '1';
	  }else{
	    echo $errmsg = '0';
	  }
 }
?>