<script type="text/javascript">
	$(function(){
		$('input').checkBox();
		$('#toggle-all').click(function(){
		$('#toggle-all').toggleClass('toggle-checked');
		$('#form_employeemgt input[type=checkbox]').checkBox('toggle');
		return false;
		});
	});
</script> 
<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/employeemanagement.js"></script>
<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script>
<style type="text/css">
 .showerror{
 display:block;
}
.removerror{
  display:none;
}
</style>
<div style="display:none;">
  <div id="inline_2" style="width:550px;min-height:300px;">
  <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="535" height="35" class="popup_bg" ><table width="520" border="0" cellspacing="0" cellpadding="0" align="left">
            <tr>
              <td colspan="2" >Search</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="20"></td>
      </tr>
      <tr>
        <td height="100" align="center" valign="top" style="padding-left:12px;">
        	<form id="form_search" action="" name="form_search" method="post" enctype="multipart/form-data" >
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="5" align="center" class="popup_listing_border_search" colspan="3" id="searchmsg">
                     </td>                   
                  </tr>
				  <tr class="light_bg">
					<td width="130" align="right" class="popup_listing_border" valign="middle"><strong>First Name</strong></td>
					<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
					<td width="459" align="left" class="popup_listing_border" valign="middle">
					<input type="text" class="input_box"  name="txt_srchfname" id="txt_srchfname" />	  
					</td>
				  </tr>
				  <tr class="white_bg">
					<td align="right" class="popup_listing_border" valign="middle"><strong>Last Name:</strong></td>
					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>
					<td align="left" class="popup_listing_border">
					 <input type="text" class="input_box"  name="txt_srchlname" id="txt_srchlname"  />
					</td>
				  </tr>
				  <tr class="light_bg">
					<td align="right" class="popup_listing_border" valign="middle"><strong>Email Address:</strong></td>
					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>
					<td align="left" class="popup_listing_border">
					 <input type="text" class="input_box"  name="txt_srchemail" id="txt_srchemail"  />
					</td>
				  </tr>
				 <tr class="white_bg">
					<td align="right" class="popup_listing_border" valign="middle"><strong>User Type :</strong></td>
					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>
					<td align="left" class="popup_listing_border" valign="middle">
				   <select name="sel_srchusertypr" id="sel_srchusertypr" class="select_box">
						 <option value="">Select User Type</option>
						<option value="0">Super Admin</option>
						<option value="1">Employee</option>
					 </select>
					</td>
				  </tr>
				  <tr class="light_bg">
					<td align="right" class="popup_listing_border" valign="middle"><strong>Status :</strong></td>
					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>
					<td align="left" class="popup_listing_border" valign="middle">
				   <select name="sel_srchstatus" id="sel_srchstatus" class="select_box">
						 <option value="">Select Status</option>
						<option value="0">Inactive</option>
						<option value="1">Active</option>
					 </select>
					</td>
				  </tr>
				  <tr class="white_bg">
					<td align="right" class="popup_listing_border">&nbsp;</td>
					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>
					<td align="left" class="popup_listing_border">
					<input type="hidden" name="fieldname" id="fieldname" value="0" />
					 <input type="hidden" name="curr_page" id="curr_page" value="0" />
					<input type="hidden" name="prevnext" id="prevnext" value="0" />
					 <input type="hidden" name="row" id="row" value="20" />
					<input type="hidden" name="viewdiv" id="viewdiv" value="1" />
					 <input type="hidden" name="search" id="search" value="1" />
					 <input class="button_bg" type="submit" value="Submit" name="btn_search" onclick="return searching()">
					</td>
				  </tr>
				</table>
			</form>
        </td>
      </tr>
      <tr>
        <td align="left" valign="top" style="padding-left:12px;">&nbsp;</td>
      </tr>
    </table>
</div>
</div>
<a id="various_2" href="#inline_2"></a>

   <div id="table-content">
	<div id="message-red">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr> 
		<td class="red-left" id="err"></td>
		<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
	</tr>
	</table>
	</div>
	<div id="message-green">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td class="green-left" id="succ"></td>
		<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
	</tr>
	</table>
	</div>
	<div id="<?php echo $_GET['pid'] ?>">
	<div class="searchdiv">
		  <table class="searchdiv" border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="13%" align="left"><?php
			if($controller_class -> getemployee != ''){
			?>
				<div id="actions-box"> <a href="" class="action-slider"></a>
				  <div id="actions-box-slider"> <a style="cursor:pointer" class="action-delete" onclick="deleteselected()" id="testCheck">Delete</a> <a style="cursor:pointer" class="action-delete" onclick="statusactive()" id="testCheck">Active</a> <a style="cursor:pointer" class="action-delete" onclick="statusinactive()" id="testCheck">Inactive</a> </div>
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
	if($controller_class -> getemployee != ''){
		foreach($controller_class -> getemployee  as $k => $data){
			$i++;
  ?>
	<tr id="<?php echo $data['adminid']?>" class="<?php if($i%2==0){ echo "light_bg"; }else{ echo "white_bg"; } ?>" height="30">
		<td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['adminid'];  ?>"/></td>
		 <td class="cursorpointer" onclick="edit('<?php echo $data['adminid'] ?>','<?php echo $_GET['pid']?>')"><?php echo stripslashes($data['firstname'])." ".stripslashes($data['lastname']) ?></td>
		<td><?php echo stripslashes($data['email']) ?></td>
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
					<td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['adminid'] ?>','<?php echo $_GET['pid']?>')"></a></td>
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
		if($controller_class -> getemployee != ''){
			echo $model_class->paging_advancesearch($controller_class -> gettotalpageno,20,ceil($controller_class -> gettotalpageno/20));
	  ?>
		  <?php }else{ ?>
		  <input type="hidden" name="sel_noofrow" id="sel_noofrow" value="20" />
		  <?php }?>
		  <input type="hidden" name="hid_fieldname" id="hid_fieldname"    value=""  />
		  <input type="hidden" name="hidsearch" id="hidsearch" value="0" />
		  <input type="hidden" name="viewdiv" id="viewdiv" value="1" />
		</form>
	  </div>
	</div>