<?php

if (isset($_SESSION['ADMIN_ID']) && $_SESSION['ADMIN_ID'] != '')
{
	header('location: index.php?pid=dashboard');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login - ProjectName</title>
<link rel="icon" type="image/png" href="<?=$LOCATION['SITE_ADMIN']?>images/favicon.ico">
<!--  jquery core -->
<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery-1.4.1.min.js"></script>

<!-- Custom jquery scripts -->
<script src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/custom_jquery.js" type="text/javascript"></script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/loginscripts.js"></script>
<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/defaultscript.js"></script>
<?php /*?><script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
$("#txt_username").focus();
});
</script><?php */?>
<link href="stylesheets/styles_new.css" rel="stylesheet" type="text/css" />
	   <!--[if lte IE 7]><!-->
<link href="stylesheets/ie7styles_new.css" rel="stylesheet" type="text/css" />
<!--<![endif]-->
<!--[if ! lte IE 7]><!-->
<link href="stylesheets/styles_new.css" rel="stylesheet" type="text/css" />
<!--<![endif]-->
<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
var site_url = "<?=$_SESSION['ADMIN_DOMAIN_NAME']?>";
</script>
<!--<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/ui.checkbox.js"></script> -->
<link rel="stylesheet" type="text/css" href="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.fancybox-1.3.4.css" media="screen" />
<link href="<?=$LOCATION['SITE_ADMIN']?>stylesheets/screenlogin.css" rel="stylesheet" type="text/css" />
</head>
<body class="login_bg"> 
<div style="display:none;">
  <div id="inline_1" style="min-width:500px;min-height:150px;">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="95%" height="35" class="popup_bg" ><table width="92%" border="0" cellspacing="0" cellpadding="0" align="left">
            <tr>
              <td colspan="2" ><span id="forg_title">Forgot Password</span></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="20"></td>
      </tr>
      <tr>
        <td height="100" align="center" valign="top" style="padding-left:12px;padding-right:12px;">
		<span id="forg_content" style="font-size:15px; font-weight:bold;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" align="center" class="popup_listing_border_search" colspan="3" id="searchmsg"></td>
              </tr>
              <tr class="light_bg">
                <td width="130" align="right" class="popup_listing_border" valign="middle"><strong>Your Email Id :</strong></td>
                <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
                <td width="459" align="left" class="popup_listing_border" valign="middle"><input type="text" class="input_box"  name="txt_forgot_email" id="txt_forgot_email" />
                </td>
              </tr>
              <tr class="light_bg">
                <td align="right">&nbsp;</td>
                <td height="37" align="left">&nbsp;</td>
                <td align="left">
                  <input class="button_bg" type="button" value="Submit" name="btn_search" onclick="return forgot_password_function()">
                </td>
              </tr>
            </table>
		</span>
		
		</td>
      </tr>
	 
      <tr>
        <td align="left" valign="top" style="padding-left:12px;">&nbsp;</td>
      </tr>
    </table>
</div>
</div>
<a id="various_1" href="#inline_1"></a>
 <div class="wrapper">
  <div class="login_header">
<div class="login_content_main">
<div class="login_logo"><!--<a href="#"><img src="images/logo_login.png" alt="logo"></a>--></div>
<div class="login_content_bg">
<form name="Form_login" id="Form_login" action="" enctype="multipart/form-data" method="post">
<div class="login_main"><div class="login_field_main">
<div class="login_field">
    User Name </div>
<div class="login_field">  <input type="text" name="txt_username" id="txt_username" class="login_input" value="<?php if(isset($_COOKIE['adminfausername']) && $_COOKIE['adminfausername'] != '') echo $_COOKIE['adminfausername'] ?>" style="color:#4679BD;"></div>
</div>
<div class="login_field_main1">
<div class="login_field">Password</div>
<div class="login_field">  <input type="password" name="txt_password" id="txt_password" class="login_password" value="<?php if(isset($_COOKIE['adminfapswd']) && $_COOKIE['adminfapswd'] != '') echo $_COOKIE['adminfapswd'] ?>" onfocus="this.value=''" style="color:#4679BD;"  >
</div>
</div>
<div class="remember_main">
<div class="check_box">
          <input type="checkbox" class="myClass" id="login-check" name="login-check"  value="1" <?php if(isset($_COOKIE['adminfapswd']) && $_COOKIE['adminfapswd'] != '') echo "checked='checked'" ?> />
     </div>
	 <div class="remember" style="padding-top:2px; color:#4679BD;">Remember me</div>
	  <div class="forgot"><!--<a id="various11" style="cursor:pointer; color:#4679BD;" onclick="$('#various_1').fancybox().trigger('click');">Forgot Password?</a>--></div>
</div>
<div class="login_field_main"><input type="submit" id="btn_login" name="button" value="Login" class="login_button" onclick="return validatelogin();" style="background-color: #4679BD; border:1px solid #4679BD;"/></div>
<div class="clear"></div>
<br />

<?php
		 if(isset($_SESSION['Msg']) && $_SESSION['Msg'] != ''){
		?>
        <div ><p style="background-color: #F3C598;border: 1px solid #E8B084;color: #BA4C32;z-index: 1;padding:15px 15px 15px 40px;background-image: url('images/msg-error.gif');background-repeat:no-repeat;background-position:5px 13px;"><strong><?php echo $_SESSION['Msg']; unset($_SESSION['Msg']); ?></strong></p></div>
<?php 
		 }
?>        
</div>

</form>


</div>
<div class="clear"></div>
</div>
  <div class="clear"></div>
</div>
<div class="push"></div>
<div class="clear"></div>
</div>

<footer>
  <div class="footer">
    <div class="footer_bg">
      <div class="bottom_content1">
        <div class="bottom_left">          
          <div class="copy">© 2013 ProjectName Services Power Panel</div>
        </div>
        <div class="bottom_right1" style="width:10%"> Crafted by <a href="http://www.vrinsofts.com/" style="color:#ABABAB; text-decoration:none;">ME</a>&nbsp;&nbsp;&nbsp;<!--<a href="http://www.roars.in/"> <img src="images/r.png" alt="logo" class="bottom_logo"></a> --></div>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</footer>

<?php /*?><!-- Start: login-holder -->
<div id="login-holder">

	<!-- start logo -->
	<div id="logo-login">
		<a href="<?=$_SESSION['ADMIN_DOMAIN_NAME']?>"><img src="<?=$LOCATION['SITE_ADMIN']?>images/logo.png" width="156" height="40" alt="" /></a>
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
    <form name="Form_login" id="Form_login" action="" enctype="multipart/form-data" method="post">
		<table border="0" cellpadding="0" cellspacing="0">
        <?php
		 if(isset($_SESSION['Msg']) && $_SESSION['Msg'] != ''){
		?>
        <tr>
          <td colspan="2" class="login" height="30" id="sessionlogin" >
		  <?php echo $_SESSION['Msg']; unset($_SESSION['Msg']); ?></td>
        </tr>
        <tr><td width="10" height="10"></td></tr>
        <?php } ?>
          <tr>
			<td colspan="2" class="login" height="30" id="login" style="display:none;"></td>
		</tr>
         <tr><td width="10" height="10"></td></tr>
		<tr>
			<th>Username</th>
			<td><input type="text"  class="login-inp" name="txt_username" id="txt_username" 
             value="<?php if(isset($_COOKIE['adminfausername']) && $_COOKIE['adminfausername'] != '') echo $_COOKIE['adminfausername'] ?>"/></td>
		</tr>
		<tr>
			<th>Password</th>
			<td>
            <input type="password"   onfocus="this.value=''" 
              class="login-inp" name="txt_password" id="txt_password" value="<?php if(isset($_COOKIE['adminfapswd']) && $_COOKIE['adminfapswd'] != '') echo $_COOKIE['adminfapswd'] ?>"/>
            </td>
		</tr>
		<tr>
			<th></th>
			<td valign="top">
            <input type="checkbox" class="checkbox-size" id="login-check" name="login-check"  value="1" <?php if(isset($_COOKIE['adminfapswd']) && $_COOKIE['adminfapswd'] != '') echo "checked='checked'" ?>   />
            <label for="login-check">Remember me</label></td>
		</tr>
		<tr>
			<th></th>
			<td>
            <input type="submit" id="btn_login" name="btn_login" value="Login" class="submit-login" onclick="return validatelogin();"/> 
            </td>
		</tr>
		</table>
        </form>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
	<!--<a href="" class="forgot-pwd">Forgot Password?</a> -->
 </div>
 <!--  end loginbox -->
 
	<!--  start forgotbox ................................................................................... -->
	<div id="forgotbox">
		<div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
		<!--  start forgot-inner -->
		<div id="forgot-inner">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Email address:</th>
			<td><input type="text" value=""   class="login-inp" /></td>
		</tr>
		<tr>
			<th> </th>
			<td><input type="button" class="submit-login"  /></td>
		</tr>
		</table>
		</div>
		<!--  end forgot-inner -->
		<div class="clear"></div>
		<a href="" class="back-login">Back to login</a>
	</div>
	<!--  end forgotbox -->

</div>
<!-- End: login-holder -->
<?php */?></body>
</html>
