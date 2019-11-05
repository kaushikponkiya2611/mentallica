<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script>
<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/changepasswordscripts.js"></script>
<style type="text/css">
.showerror{
	display:block;
}
.removerror{
	display:none;
}
</style>

<div id="table-content">
<!--  start message-red -->
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
	<td class="green-right"><a class="close-green">
	<img src="images/table/icon_close_green.gif" alt="" /></a>
	</td>
</tr>
</table>
</div>

<div id="<?php echo $_GET['pid'] ?>" >
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
	<input type="hidden" name="h_password" id="h_password" value="" />	
	<input class="button_bg" type="submit" value="Submit" name="btn_save" onclick="return adddata()">
	<input type="reset" value="Reset" class="button_bg" name="btn_reset"  />
	</td>
	<td>&nbsp;</td>
	 </tr>
	</table>
</form>
</div>
</div>