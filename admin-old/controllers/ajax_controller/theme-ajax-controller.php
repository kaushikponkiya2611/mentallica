<?php 
    @session_start();
	include('../../models/db.php');
	include('../../models/common-model.php');
	include('../../includes/thumb_new.php');
	include('../common-controller.php');
	$database = new Connection();
	include('../../models/ajax-model.php');
	$modelObj = new AjaxModel();
	$commoncont = new CommonController();
?>
<?php
if(isset($_POST['showtheme']) && $_POST['showtheme'] != ''){
	$mytheme=$commoncont->getSettings();	
?>
<div class="mem_list" style="width:500px;">
	<div style="width:28%; float:left;text-align:left">
		<img src="images/black_theme.jpg" width="133" height="100" />
	</div>
	<div style="width:48%; float:left;text-align:left;font-size:24px;padding-top:30px;"><strong>Black Theme</strong></div>
	<div style="width:24%; float:left;text-align:right;">	
		<?php
		if($mytheme=='screen_black.css'){
		?>
		<img src="images/true.png" />
		<?php
		}else{
		?><input class="button_bg" type="button" name="btn_activate" id="btn_activate" value="Set This Theme" onclick="active_theme('screen_black.css','<?=$_POST['mypid']?>')"><?php
		}
		?>
	</div>
	
	<div style="clear:both"></div>
</div>
<div class="mem_list" style="width:500px;">
	<div style="width:28%; float:left;text-align:left">
		<img src="images/blue_theme.jpg" width="133" height="100" />
	</div>
	<div style="width:48%; float:left;text-align:left;font-size:24px;padding-top:30px;color:#356aa0;"><strong>Blue Theme</strong></div>
	<div style="width:24%; float:left;text-align:right;">	
		<?php
		if($mytheme=='screen_blue.css'){
		?>
		<img src="images/true.png" />
		<?php
		}else{
		?><input class="button_bg" type="button" name="btn_activate" id="btn_activate" value="Set This Theme" onclick="active_theme('screen_blue.css','<?=$_POST['mypid']?>')"><?php
		}
		?>
	</div>
	
	<div style="clear:both"></div>
</div>
<div class="mem_list" style="width:500px;">
	<div style="width:28%; float:left;text-align:left">
		<img src="images/orange_theme.jpg" width="133" height="100" />
	</div>
	<div style="width:48%; float:left;text-align:left;font-size:24px;color:#FF8200;padding-top:30px;"><strong>Orange Theme</strong></div>
	<div style="width:24%; float:left;text-align:right;">
	<?php
		if($mytheme=='screen_orange.css'){
		?>
		<img src="images/true.png" />
		<?php
		}else{
		?><input class="button_bg" type="button" name="btn_activate" id="btn_activate" value="Set This Theme" onclick="active_theme('screen_orange.css','<?=$_POST['mypid']?>')"><?php
		}
	?>
	</div>
	
	<div style="clear:both"></div>
</div>
<?php
}
?>

<?php
if(isset($_POST['activatetheme']) && $_POST['activatetheme'] != ''){	
	$qry=mysql_query("update tbl_settings set theme='".$_POST['themename']."' where Id=1");
	echo $_POST['mypid'];
}
?>
