<?php 
    @session_start();
	include('../../models/db.php');
	include('../../models/common-model.php');
	include('../../includes/thumb_new.php');
	include('../common-controller.php');
	$database = new Connection();
	include('../../models/ajax-model.php');
	$modelObj = new AjaxModel();
?>
<?php 
if(isset($_POST['getpassword']) && $_POST['getpassword'] != '')
{
     $password=md5($_POST['password']);
	
	 $qry = "SELECT * FROM admin where adminid='".$_SESSION['ADMIN_ID']."'";
	$result = $modelObj -> fetchRow($qry);
	$oldpassword=$result['password'];
	
	if($password == $oldpassword)
	{
		echo "1";
	}
	else
	{
		echo "0";
	}
}?>

<?php
if(isset($_POST['hid_add']) && $_POST['hid_add'] != '')
{
		$update_admin="update admin set password='".md5($_POST['txt_newpassword'])."' where adminid='".$_SESSION['ADMIN_ID']."'";
		$qry=mysql_query($update_admin);
		if($qry)
		{ 
			 echo "1";
		}else
		{
			echo "2";
		}
	
}
?>
<?php
if(isset($_POST['viewdiv']) && $_POST['viewdiv'] != ''){
?>
<form name="form_changepassword" id="form_changepassword" method="post" enctype="multipart/form-data" action="#" >
	<table border="0"  cellpadding="0" cellspacing="0" id="id-form" width="100%">
	<tr class="light_bg">
		<th>Old Password :</th>
		<td width="25%"><input type="password" class="inp-form"  name="txt_oldpassword" id="txt_oldpassword"  onblur="checkpassword(this.value);" /><font class="required"> *</font></td>
		<td id="errortxt_oldpassword" width="55%">
		<label class="removerror error_new" id="error-innertxt_oldpassword"></label>
	  </td>
	</tr>
	<tr class="light_bg">
		<th>New Password :</th>
		<td width="25%"><input type="password" class="inp-form"  name="txt_newpassword" id="txt_newpassword"  /><font class="required"> *</font></td>
		<td id="errortxt_newpassword" width="55%">
		<label class="removerror error_new" id="error-innertxt_newpassword"></label>
	  </td>
	</tr>
	<tr class="light_bg">
		<th>Confirm Password :</th>
		<td width="25%"><input type="password" class="inp-form"  name="txt_confirmpassword" id="txt_confirmpassword"  onblur="checkfield(this)" /><font class="required"> *</font></td>
		<td id="errortxt_confirmpassword" width="55%">
		<label class="removerror error_new" id="error-innertxt_confirmpassword"></label>
	  </td>
	</tr>
	<tr class="light_bg">
	<th>&nbsp;</th>
	<td>
	<input type="hidden" name="hid_add" id="hid_add" value="add" />
	<input type="hidden" name="h_password" id="h_password" value="0" />	
	<input class="button_bg" type="submit" value="Submit" name="btn_save" onclick="return adddata()">
	<input type="reset" value="Reset" class="button_bg" name="btn_reset"  />
	</td>
	<td>&nbsp;</td>
	 </tr>
	</table>
</form>
<?php 
}?>