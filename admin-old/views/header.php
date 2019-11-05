<div id="logo"> <a href="<?=$_SESSION['ADMIN_DOMAIN_NAME']?>index.php?pid=dashboard" title="Symbol"> <img src="<?=$LOCATION['SITE_ADMIN']?>images/logo.png" alt="Symbol"/></a> </div>
<div id="top-search">
  <div> <strong><img src="images/user.png" alt="user" class="dollar_icon" >Welcome,</strong> <span class="font_red"><?php echo $_SESSION['ADMIN_FIRSTNAME']." ".$_SESSION['ADMIN_LASTNAME'] ?></span><span class="top_link">| <a href="<?=$_SESSION['ADMIN_DOMAIN_NAME']?>index.php?pid=logout" class="padding_left"> Sign Out</a></span> </div>
  <div style="padding-top:20px;padding-bottom:30px;text-align:right"> <span class="top_link">
    <a href="index.php?pid=changepassword" class="padding_right">Change Password</a>|
    <b>Last Login : <?php echo $_SESSION['LAST_LOGIN'] ?></b></span> 
	<!--<img src="images/xpd0lv.jpg" height="16" width="16" title="Change Theme" alt="Change Theme" style="cursor:pointer" onclick="change_theme('<?=$_GET['pid']?>')" /> -->
	</div>
</div>
<div class="clear"></div>

<div style="display:none;">
  <div id="inline_33" style="width:450px;min-height:120px;">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="95%" height="35" class="popup_bg" ><table width="92%" border="0" cellspacing="0" cellpadding="0" align="left">
            <tr>
              <td colspan="2">Actions</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td height="40" align="center" valign="middle" style="padding-left:12px;"><div id="action_line" style="font-size:12px;font-weight:bold;" ></div></td>
      </tr>
      <tr>
        <td height="20" align="center" valign="bottom" id="action_button">
		<input class="button_bg" type="button" value="YES" name="btn_ok" onclick="status_ok()">
		<input class="button_bg" type="button" value="NO" name="btn_ok" onclick="status_cancel()">
		</td>
      </tr>
      <tr>
        <td align="left" valign="top" style="padding-left:12px;">&nbsp;</td>
      </tr>
    </table>
</div>
</div>
<a id="various_33" href="#inline_33"></a>


<!--For View Detail - Common popup-->
<div style="display:none;">
  <div id="inline_1" style="min-width:350px;min-height:50px;">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="95%" height="35" class="popup_bg" ><table width="92%" border="0" cellspacing="0" cellpadding="0" align="left">
            <tr>
              <td colspan="2" ><div id="common" ></div></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="20"></td>
      </tr>
      <tr>
        <td height="100" align="center" valign="top" style="padding-left:12px;padding-right:12px;">
		
		<div id="view_detail" ></div>
		
		
		</td>
      </tr>
	 
      <tr>
        <td align="left" valign="top" style="padding-left:12px;">&nbsp;</td>
      </tr>
    </table>
</div>
</div>
<a id="various_1" href="#inline_1"></a>

<!--For Album Song - Common popup-->
<div style="display:none;">
  <div id="inline_11123" style="width:900px;min-height:50px;">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="95%" height="35" class="popup_bg" ><table width="92%" border="0" cellspacing="0" cellpadding="0" align="left">
            <tr>
              <td colspan="2" ><div id="common_11123" ></div></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="20"></td>
      </tr>
      <tr>
        <td height="100" align="center" valign="top" style="padding-left:12px;padding-right:12px;">
		
		<div id="view_detail_11123" ></div>
		
		
		</td>
      </tr>
	 
      <tr>
        <td align="left" valign="top" style="padding-left:12px;">&nbsp;</td>
      </tr>
    </table>
</div>
</div>
<a id="various_11123" href="#inline_11123"></a>


<!--For Status Change - Common popup-->
<div style="display:none;">
  <div id="inline_3" style="width:400px;height:120px;">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="385" height="35" class="popup_bg" ><table width="370" border="0" cellspacing="0" cellpadding="0" align="left">
            <tr>
              <td colspan="2" >Change Status</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td height="40" align="center" valign="middle" style="padding-left:12px;"><div id="status_line" style="font-size:12px;font-weight:bold;" ></div></td>
      </tr>
      <tr>
        <td height="20" align="center" valign="bottom">
		<input class="button_bg" type="button" value="Ok" name="btn_ok" onclick="status_ok()">
		<input class="button_bg" type="button" value="Cancel" name="btn_ok" onclick="status_cancel()">
		</td>
      </tr>
      <tr>
        <td align="left" valign="top" style="padding-left:12px;"><input type="hidden" id="h_status" name="h_status" /><input type="hidden" id="h_statustype" name="h_statustype" /></td>
      </tr>
    </table>
</div>
</div>
<a id="various_3" href="#inline_3"></a>

<div style="display:none;">
  <div id="inline_3s" style="width:400px;height:120px;">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="385" height="35" class="popup_bg" ><table width="370" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
              <td colspan="2" id="activestatus_line_head">Featured</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td height="40" align="center" valign="middle" style="padding-left:12px;"><div id="activestatus_line" style="font-size:12px;font-weight:bold;" ></div></td>
      </tr>
      <tr>
        <td height="20" align="center" valign="bottom">
		<!--<a style="cursor:pointer;font-weight:bold;text-decoration:none;" onclick="status_ok()"><img src="images/popup_ok.png" /></a>&nbsp;&nbsp;<a style="cursor:pointer;font-weight:bold;text-decoration:none;" onclick="status_cancel()"><img src="images/popup_cancel.png" /></a>-->
		<input class="button_bg" type="button" value="Ok" name="btn_ok" onclick="status_okf()">
		<input class="button_bg" type="button" value="Cancel" name="btn_ok" onclick="status_cancel()">
		</td>
      </tr>
      <tr>
        <td align="left" valign="top" style="padding-left:12px;"><input type="hidden" id="h_activestatus" name="h_activestatus" /><input type="hidden" id="h_activestatustype" name="h_activestatustype" /></td>
      </tr>
    </table>
</div>
</div>
<a id="various_3s" href="#inline_3s"></a>

<!--For Delete - Common popup-->
<div style="display:none;">
  <div id="inline_4" style="width:400px;height:120px;">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="385" height="35" class="popup_bg" ><table width="370" border="0" cellspacing="0" cellpadding="0" align="left">
            <tr>
              <td colspan="2" >Delete</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td height="40" align="center" valign="middle" style="padding-left:12px;"><div id="delete_line" style="font-size:12px;font-weight:bold;" ></div></td>
      </tr>
      <tr>
        <td height="20" align="center" valign="bottom">
		<input class="button_bg" type="button" value="Yes" name="btn_yes" onclick="delete_ok()">
		<input class="button_bg" type="button" value="No" name="btn_no" onclick="status_cancel()">
		</td>
      </tr>
      <tr>
        <td align="left" valign="top" style="padding-left:12px;"><input type="hidden" id="h_delete" name="h_delete" /></td>
      </tr>
    </table>
</div>
</div>
<a id="various_4" href="#inline_4"></a>
<input type="hidden" name="h_orderby" id="h_orderby" />

<a id="various_32" href="#inline_32"></a>
<div style="display:none;">
  <div id="inline_32" style="width:570px;">
    <div id="div_voucherprint"></div>
  </div>
</div>

<input type="hidden" name="hid_step1" id="hid_step1" />
<input type="hidden" name="hid_step2" id="hid_step2" />